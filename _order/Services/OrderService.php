<?php
/**
 * FileName: OrderService.php
 * Description: 填写该类功能描述
 * @author: 翁昌水
 * @Create Date: 2021/10/12 14:40
 * @version v1.0
 */


namespace Order\Services;


use App\Models\Order;

class OrderService
{
    public function cancel($orderSn)
    {
        Order::where('ordersn', $orderSn)->update(['status'=> -10]);
    }
}
