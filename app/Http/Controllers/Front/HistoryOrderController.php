<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Service\Order\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HistoryOrderController extends Controller
{

    private $orderService;
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $orders = Order::where('user_id', $user_id)->get();
        $receiveOrders = Order::where('status', 4)->where('user_id', $user_id)->get();
        $shipping = Order::where('status', 3)->where('user_id', $user_id)->get();
        $paid = Order::where('status', 1)->where('user_id', $user_id)->get();
        $processing = Order::where('status', 2)->where('user_id', $user_id)->get();
        $cancel = Order::where('status', 5)->where('user_id', $user_id)->get();
        return view('front.historyOrder.index', compact('user_id', 'orders', 'receiveOrders', 'shipping', 'paid', 'processing', 'cancel'));
    }

    public function cancelOrder($id)
    {
        $order = $this->orderService->find($id);
        $order->status = 5;
        $order->save();
        return redirect('historyorder');
    }
}
