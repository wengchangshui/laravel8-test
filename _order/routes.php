<?php
/**
 * Copyright (C), 2016-2018, Shall Buy Life info. Co., Ltd.
 * FileName: routes.php
 * Description: 填写该类功能描述
 * @author 翁昌水
 * @Create Date 2021/09/29 15:09
 * @Update Date 2021/09/29 15:09 By 翁昌水
 * @version v1.0
 */

use Illuminate\Support\Facades\Route;
use Order\Controllers\OrderController;

Route::group(['prefix' => 'index','middleware' => 'checkUser'], function () {
    Route::get('index', function () {
        return 'aa';
    })->withoutmiddleware('checkUser');
    Route::get('index2', [OrderController::class, 'index'])->name('index.index2');
    Route::get('test', [OrderController::class, 'test'])->name('index.test');
});
