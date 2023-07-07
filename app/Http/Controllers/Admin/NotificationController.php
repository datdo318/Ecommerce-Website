<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

use App\Service\Order\OrderServiceInterface;

class NotificationController extends Controller
{

    private $orderService;
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function notification(Request $request)
    {
        if ($request->ajax()) {
            $order = $this->orderService->find($request->orderId);
            $response['order_id'] = $request->orderId;
            $response['image'] = $order->orderDetails[0]->product->productImages[0]->path;
            $response['order_date'] = $order->created_at;
            $response['name'] = $order->first_name;
            return $response;
        }
        return back();
    }
}
