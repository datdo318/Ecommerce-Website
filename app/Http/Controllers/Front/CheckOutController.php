<?php

namespace App\Http\Controllers\Front;

use App\Events\PlacedNotification;
use App\Http\Controllers\Controller;
use App\Service\Order\OrderServiceInterface;
use App\Service\OrderDetail\OrderDetailService;
use App\Service\OrderDetail\OrderDetailServiceInterface;
use App\Utilities\Constant;
use App\Utilities\VNPay;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Notification;

class CheckOutController extends Controller
{
    private $orderService;
    private $orderDetailService;

    public function __construct(
        OrderServiceInterface $orderService,
        OrderDetailServiceInterface $orderDetailService
    ) {
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }

    public function index()
    {
        $carts = Cart::content();
        $total = Cart::totalFloat();
        $subtotal = Cart::subtotalFloat();
        return view('front.checkout.index', compact('carts', 'total', 'subtotal'));
    }

    public function addOrder(Request $request)
    {
        //1. Them don hang
        $data = $request->all();
        $data['status'] = Constant::order_status_Processing;
        $order = $this->orderService->create($data);
        //2. Them chi tiet don hang
        $carts = Cart::content();

        foreach ($carts as $cart) {
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'amount' => $cart->price,
                'total' => $cart->qty * $cart->price,
            ];

            $this->orderDetailService->create($data);
        }

        if ($request->payment_type == 'pay_later') {
            //Gui mail
            $total = Cart::totalFloat();
            $subtotal = Cart::subtotalFloat();
            if (Cart::count() > 0) {
                $this->sendEmail($order, $total, $subtotal); //Goi ham gui maii da duoc dinh nghia
                $notification = new Notification();
                $notification->order_id = $order->id;
                $notification->save();
                event(new PlacedNotification($notification));
                //3. Xoa gio hang
                Cart::destroy();
                //4. Tra ve ket qua thong bao
                return redirect('checkout/result')
                    ->with('notification', 'Thành công! Bạn sẽ thanh toán khi nhận hàng. Xin vui lòng kiểm tra email.');
            } else {
                return redirect('checkout/result')
                    ->with('notification', 'Bạn vui lòng lựa chọn sản phẩm để thanh toán.');
            }
        }

        if ($request->payment_type == 'online_payment') {
            // 1. Lay URL thanh toan VNpay
            // $data_url = VNPay::vnpay_create_payment([
            //     'vnp_TxnRef' => $order->id, //ID cua don hang
            //     'vnp_OrderInfo' => 'Mo ta don hang', //Mo ta don hang
            //     'vnp_Amount' => Cart::total(0, '', ''), //Tong gia don hang
            // ]);

            // //2.Chuyen huong toi URL lay duoc
            // return redirect()->to($data_url);
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/checkout/vnPayCheck";
            $vnp_TmnCode = "MY5750L5"; //Mã website tại VNPAY 
            $vnp_HashSecret = "RVBURETPSSCDYMJGILAVZZHENSLQXEGC"; //Chuỗi bí mật

            $vnp_TxnRef = $order->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Mô tả đơn hàng';
            // $vnp_OrderType = 'billpayment';
            $vnp_Amount = Cart::total(0, '', '') * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                // "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                return redirect()->to($returnData['data']);
                // echo json_encode($returnData['data']);
            }
        }
    }

    public function vnPayCheck(Request $request)
    {
        //1. Lay data tu URL
        $vnp_TxnRef = $request->get('vnp_TxnRef'); //order_id
        $vnp_Amount = $request->get('vnp_Amount');
        $vnp_ResponseCode = $request->get('vnp_ResponseCode'); //Ma phan hoi ket qua thanh toan. 00: thanh cong


        //2. Kiem tra data, xem ket qua giao dich tra ve tu VNpay hop le khong
        if ($vnp_ResponseCode != null) {
            if ($vnp_ResponseCode == 00) {
                //Cap nhat trang thai Order
                $this->orderService->update(['status' => Constant::order_status_Processing], $vnp_TxnRef);

                //Gui mail
                $order = $this->orderService->find($vnp_TxnRef);
                $total = Cart::totalFloat();
                $subtotal = Cart::subtotalFloat();
                $this->sendEmail($order, $total, $subtotal);

                //Xoa gio hang
                Cart::destroy();
                //Thong bao ket qua
                return redirect('checkout/result')
                    ->with('notification', 'Thành công! Đã thanh toán. Xin vui lòng kiểm tra email.');
            } else {
                //Xoa don hang da them vao database
                $this->orderService->delete('vnp_TxnRef');
                return redirect('checkout/result')
                    ->with('notification', 'Thất bại! Thanh toán không thành công');
            }
        }
    }

    public function result()
    {
        $notification = session('notification');
        return view('front.checkout.result', compact('notification'));
    }

    private function sendEmail($order, $total, $subtotal)
    {
        $email_to = $order->email;
        Mail::send(
            'front.checkout.email',
            compact('order', 'total', 'subtotal'),
            function ($message) use ($email_to) {
                $message->from('datvbhp123@gmail.com', 'Fashion_Shop');
                $message->to($email_to, $email_to);
                $message->subject('Order Notification');
            }
        );
    }
}
