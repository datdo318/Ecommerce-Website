<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Service\Order\OrderServiceInterface;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class OrderController extends Controller
{
    private $orderService;
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = $this->orderService->searchAndPaginate('first_name', $request->get('search'));
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->orderService->find($id);

        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status = $request->status_order;
        $order = $this->orderService->find($id);
        $order->status = $status;
        $order->save();

        return redirect('admin/order');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print_order($order_id)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($order_id));
        return $pdf->stream();
    }

    public function print_order_convert($order_id)
    {
        $order = $this->orderService->find($order_id);
        $user = $order->user_id;
        $order_details = OrderDetail::where('order_id', $order_id)->get();
        $id = 0;
        $output = '';

        $output .= '<style> 
            body{
                margin: 0;
                padding: 0;
                background-color: #FAFAFA;
                font-family: DejaVu Sans;
            }
            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }
            .page {                
                overflow:hidden;
                min-height:297mm;
                padding: 20px;
                margin: 0 auto;            
                background: white;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }
            @page {
                size: A4;
                margin: 0;
            }
    
            .header {
                
            }
            .logo {
                background-color:#FFFFFF;
                text-align:left;
                float:left;
            }
            .company {
                padding: 24px;
                text-transform:uppercase;
                background-color:#FFFFFF;
                text-align:right;
                float:right;
                font-size:16px;
            }
            .title {                            
                color:#000000;
                font-size: 24px;
                margin-left: 200px;                             
            }
            
            .footer-left {
                text-align:center;
                text-transform:uppercase;
                padding-top:24px;
                position:relative;
                height: 150px;
                width:50%;
                color:#000;
                float:left;
                font-size: 12px;
                bottom:1px;
            }
            .footer-right {
                text-align:center;
                text-transform:uppercase;
                padding-top:24px;
                position:relative;
                height: 150px;
                width:50%;
                color:#000;
                font-size: 12px;
                float:right;
                bottom:1px;
            }
            .TableData {
                background:#ffffff;
                font: 11px;
                width:100%;
                border-collapse:collapse;               
                font-size:12px;
                border:thin solid #d3d3d3;
            }
            .TableData th {
                background: rgba(0,0,255,0.1);
                text-align: center;
                font-weight: bold;
                color: #000;
                border: solid 1px #ccc;
                height: 24px;
            }
            .TableData tr {
                height: 24px;
                border:thin solid #d3d3d3;
            }
            .TableData tr td {
                padding-right: 2px;
                padding-left: 2px;
                border:thin solid #d3d3d3;
            }
            .TableData tr:hover {
                background: rgba(0,0,0,0.05);
            }
            .TableData .cotSTT {
                text-align:center;
                width: 50px;
            }
            .TableData .cotTenSanPham {
                text-align:left;
                width: 40%;
            }
            .TableData .cotHangSanXuat {
                text-align:left;
                width: 20%;
            }
            .TableData .cotGia {
                text-align:right;
                width: 120px;
            }
            .TableData .cotSoLuong {
                text-align: center;
                width: 50px;
            }
            .TableData .cotSo {
                text-align: right;
                width: 120px;
            }
            .TableData .tong {
                text-align: right;
                font-weight:bold;
                text-transform:uppercase;
                padding-right: 4px;
            }
            .TableData .cotSoLuong input {
                text-align: center;
            }
            @media print {
             @page {
             margin: 0;
             border: initial;
             border-radius: initial;
             width: initial;
             min-height: initial;
             box-shadow: initial;
             background: initial;
             page-break-after: always;
            }
            }        
        </style>
        <body onload="window.print();">
        <div id="page" class="page">
            <h2><center>Cộng hòa xã hội chủ nghĩa Việt Nam</center></h2>
            <h4><center>Độc lập - Tự do - Hạnh phúc</center></h4>
            <div class="header">
                <div class="company">C.Ty TNHH abc</div>             
            </div>            
            <br/>
            <div class="title">
                <h3><center>HÓA ĐƠN THANH TOÁN</center></h3>              
            </div>
            <br/>
            <p>Thông tin khách hàng: </p>
            <br/>
            <table class="TableData">
                <tr>
                <th>Khách hàng</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                </tr>';
        $output .= '       
                <tr>
                    <td>' . $order->first_name . '</td>
                    <td>' . $order->street_address . '</td>  
                    <td>' . $order->phone . '</td> 
                    <td>' . $order->email . '</td>                    
                </tr>';
        $output .= '
            </table>
            <br/>
            <p>Chi tiết đơn hàng: </p>
            <br/>
            <table class="TableData">
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>';
        foreach ($order_details as $order) {
            $id = $id + 1;
            $output .= '    
                <tr>
                    <td class="cotSTT">' . $id . '</td> 
                    <td class="cotTenSanPham">' . $order->product->name . '</td>
                    <td class="cotGia">' . number_format($order->amount, 0, ',', '.') . '</td>
                    <td class="cotSoLuong">' . $order->qty . '</td>   
                    <td class="cotSo">' . number_format($order->total, 0, ',', '.') . '</td>               
                </tr>';
        }
        $output .= '
                <tr>
                    <td colspan="4" class="tong">Tổng cộng</td> 
                    <td class="cotSo">' . number_format(array_sum(array_column($order_details->toArray(), 'total')), 0, ',', '.')  . '</td>             
                </tr>
            </table>
            <div class="footer-left"> Hải Phòng, ngày 06 tháng 08 năm 2023<br/>
                Khách hàng </div>
            <div class="footer-right"> Hải Phòng, ngày 06 tháng 08 năm 2023<br/>
                Nhân viên </div>
            </div>
        </body>';

        return $output;
    }
}
