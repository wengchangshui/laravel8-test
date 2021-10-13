<?php
/**
 * Copyright (C), 2016-2018, Shall Buy Life info. Co., Ltd.
 * FileName: ${FILE_NAME}
 * Description: 填写该类功能描述
 * @author 翁昌水
 * @Create Date 2021/09/29 15:41
 * @Update Date 2021/09/29 15:41 By 翁昌水
 * @version v1.0
 */

namespace Order\Controllers;


use App\Jobs\cancel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class OrderController extends Controller
{
    public function index()
    {
        return 'this is _order index';
    }

    public function test(Request $request)
    {
//        $a = PackageTest::test_rtn('Aex');
//        var_dump($a);
//        $order = Order::find(1);
//        event(new testListen($order));
        $redis = Redis::set('testA', 'AAA');
        $abc = Redis::get('testA');
//        phpinfo();
    }

    public function testJob(Request $request)
    {
//        $orderSnArr = $request->input('orderSn');

//        foreach($orderSnArr as $orderSn){
//            $job = dispatch(new cancel($orderSn))
//                ->onQueue('cancel')
//                ->delay(now()->addSeconds(20));
//        }

//        dd($orderSnArr);


        $job = dispatch(new cancel('232001071136349335'))
            ->onQueue('order')
            ->delay(now()->addSeconds(20));

        $job = dispatch(new cancel('232001071138156868'))
            ->onQueue('cancel')
            ->onConnection('redis')
            ->delay(now()->addSeconds(20));

//        cancel::dispatch(new cancel('232001061556106845'))
//            ->onQueue('order')
//            ->onConnection('redis')
//            ->delay(now()->addSeconds(120));

//        cancel::dispatch(new cancel('232001061917388848'))
//            ->onConnection('database')
//            ->delay(now()->addSeconds(120));
    }
}
