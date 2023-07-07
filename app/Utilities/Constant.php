<?php

namespace App\Utilities;

class Constant
{
    //Cac hang so dung chung cho toan he thong

    //Order
    const order_status_Paid = 1;
    const order_status_Processing = 2;
    const order_status_Shipping = 3;
    const order_status_ReceiveOrders = 4;
    const order_status_Cancel = 5;

    public static $order_status = [
        self::order_status_Paid => 'Đã thanh toán',
        self::order_status_Processing => 'Chờ xác nhận',
        self::order_status_Shipping => 'Đang vận chuyển',
        self::order_status_ReceiveOrders => 'Đã nhận được hàng',
        self::order_status_Cancel => 'Đã hủy đơn hàng',
    ];

    //User
    const user_level_host = 0;
    const user_level_admin = 1;
    const user_level_client = 2;

    public static $user_level = [
        self::user_level_host => 'host',
        self::user_level_admin => 'admin',
        self::user_level_client => 'client',
    ];
}
