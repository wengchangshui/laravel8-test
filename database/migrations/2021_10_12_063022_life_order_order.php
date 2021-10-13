<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LifeOrderOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $type = [
            'onorder', 'scan_order', 'declaration_order', 'investment', 'car', 'member_grade',
            'estate_member_instalments', 'estate_staff_instalments', 'estate_earnest',
            'air', 'hotel', 'oil', 'rechargemobile', 'jingdong', 'taobao', 'game', 'taxis'
        ];
        Schema::create('life_order_order', function (Blueprint $table) use ($type) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->comment('销巴会员id');
            $table->tinyInteger('is_cross')->default(-1)->comment('是否跨店方式支付 -1：否 1：是');
            $table->tinyInteger('pay_status')->default(-1)->comment('是否已支付 -1：未支付   1：已支付 ');
            $table->enum('type', $type)->comment('标记各个不同的订单');
            $table->string('ordersn', 30)->comment('订单号');
            $table->tinyInteger('is_master_order')->default(-1)->comment('是否主订单 1:是  -1：不是');
            $table->string('master_order_sn', 30)->default('')->comment('主订单号');
            $table->unsignedInteger('storeid')->comment('店铺id');
            $table->smallInteger('status')->default(10)->comment(' 订单状态：-10 订单关闭 10待付款 15支付中 20已付款 30已发货 40待评价（已结算） 50交易完成 ');
            $table->decimal('deduct_coin', 10, 2)->default(0.00)->comment('红包抵扣金额（与实付金额同级）');
            $table->decimal('deduct_credits', 10, 2)->default(0.00)->comment('积分抵扣金额（与实付金额同级）');
            $table->decimal('actual_amount', 10, 2)->default(0.00)->comment('实付金额 = 订单金额 - 红包抵扣金额 - 积分抵扣金额');
            $table->decimal('order_amount', 10, 2)->default(0.00)->comment('订单金额 = 积分抵扣金额 + 红包抵扣金额 + 实付金额  = 订单原价 - 商家优惠金额 - 平台优惠金额');
            $table->decimal('total_amount', 10, 2)->default(0.00)->comment('订单原价（商品总价+运费）没有任何折扣的');
            $table->decimal('return_credits', 10, 2)->default(0.00)->comment('返还用户积分 （"返"字样判断）');
            $table->decimal('after_sale_amount', 10, 2)->default(0.00)->comment('已完成售后金额（用户退款金额）');
            $table->decimal('store_service_rate', 5, 2)->default(0.00)->comment('服务费比例（商家分润比例）');
            $table->decimal('store_profit_sharing_amount', 10, 2)->default(0.00)->comment('商家分润金额=(订单金额-用户退款金额)*(1-服务费比例)   （结算的时候就用这个值，如果发生退款，不管在结算前或结算后那该值也会相应变化）');
            $table->decimal('store_service_amount', 10, 2)->default(0.00)->comment('商家服务费金额=(订单金额-用户退款金额)*服务费比例  （该钱是返给平台的，只做记录，如果发生退款，那么该值重新计算）');
            $table->decimal('store_refund_amount', 10, 2)->default(0.00)->comment('追回商家退款金额=用户退款金额*(1-服务费比例)   （如果发生退款，那么该值重新计算）');
            $table->decimal('settle_store_credits', 10, 2)->default(0.00)->comment('结算时给商家返的积分（该值结算时决定，就再也不会变动）（一般根据线下商户的返利额度进行限制，还需要判断是否是事业部门店，如果是，那么还需要判断事业部门店是否有返利额度限制，如果没有限制就可以无限加）');
            $table->decimal('deduct_active', 10, 2)->default(0.00)->comment(' 平台优惠金额');
            $table->string('charge_transaction_no', 64)->default('')->comment('平台支付流水号（三方，支付宝或微信）');
            $table->string('charge_id', 32)->default('')->comment('平台支付服务id ');
            $table->string('order_transaction_no', 64)->default('')->comment('存管支付流水号（三方，支付宝或微信）');
            $table->string('order_id', 32)->default('')->comment('存管支付服务id ');
            $table->tinyInteger('pay_type')->default(0)->comment('支付方式： 1：银联支付 2：支付宝支付 3：微信支付 4.余额 5.支付宝h5支付 6.微信H5支付 ');
            $table->tinyInteger('pay_to')->default(0)->comment('资金流向 0：平台 1：存管');
            $table->timestamp('pay_time')->nullable()->comment('支付时间');
            $table->timestamp('delivery_time')->nullable()->comment('发货时间');
            $table->timestamp('settle_time')->nullable()->comment('结算时间');
            $table->timestamp('evaluate_time')->nullable()->comment('评价时间');
            $table->timestamp('close_time')->nullable()->comment('关闭时间（包括订单关闭、取消时间、全部完成售后关闭时间）');
            $table->tinyInteger('is_user_delete')->default(-1)->comment('是否用户删除 1:已删除  -1：未删除');
            $table->tinyInteger('client')->default(0)->comment('下单源 10：APP安卓；11：APPIOS; 12：WAP；13：小程序；20：PC');
            $table->json('thirdparty')->nullable()->comment('第三方登录{“user_id”:”支付宝标识”, “openid”: “微信标识”}');
            $table->unique('ordersn');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("ALTER TABLE `life_order_order` comment'主订单表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('life_order_order');
    }
}
