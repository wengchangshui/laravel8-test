<?php
/**
 * Copyright (C), 2016-2018, Shall Buy Life info. Co., Ltd.
 * FileName: Order.php
 * Description: 填写该类功能描述
 * @author 翁昌水
 * @Create Date 2021/09/29 10:03
 * @Update Date 2021/09/29 10:03 By 翁昌水
 * @version v1.0
 */


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use Searchable;

    protected $table = 'life_order_order';

    public $fillable = [
        'id',
        'is_cross',
        'pay_status',
        'member_id',
        'type',
        'ordersn',
        'master_order_sn',
        'storeid',
        'status',
        'deduct_coin',
        'actual_amount',
        'order_amount',
        'return_credits',
        'deduct_credits',
        'deduct_active',
        'total_amount',
        'store_service_rate',
        'store_profit_sharing_amount',
        'store_service_amount',
        'store_refund_amount',
        'settle_store_credits',
        'charge_transaction_no',
        'charge_id',
        'order_transaction_no',
        'order_id',
        'pay_type',
        'pay_to',
        'pay_time',
        'delivery_time',
        'settle_time',
        'evaluate_time',
        'close_time',
        'is_user_delete',
        'client',
        'is_master_order',
        'thirdparty',
        'after_sale_amount',
    ];
}
