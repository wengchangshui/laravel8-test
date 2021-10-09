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


use Illuminate\Http\Request;
use Wcs\test\Facades\PackageTest;

class OrderController extends Controller
{
    public function index()
    {
        return 'this is _order index';
    }

    public function test(Request $request)
    {
        $a = PackageTest::test_rtn('Aex');
        dd($a);
//        return view('PackageTest::package?Test', ['msg' => $a]);
    }
}
