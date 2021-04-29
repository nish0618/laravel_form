<?php

// エラーページ
Route::prefix('error')->name('error.')->group(function () {
    Route::get('/', 'ErrorController@index')->name('index');
    Route::get('apply_end', 'ErrorController@applyEnd')->name('apply_end');
    Route::get('gift_redemption_end', 'ErrorController@giftRedemptionEnd')->name('gift_redemption_end');
});

// 応募フォーム
Route::name('form.')->group(function () {
    Route::get('form', 'FormController@input')->name('input');
    Route::post('confirm', 'FormController@confirm')->name('confirm');
    Route::get('confirm', function () {
        return redirect('/form');
    });
    Route::post('complete', 'FormController@complete')->name('thanks');
    Route::get('complete', 'ErrorController@index');
});

// クーポン引き換え画面
Route::name('coupon.')->prefix('redeem/{unique_url}')->group(function () {
    Route::get('/', 'CouponController@index')->name('index');
    Route::post('apply', 'CouponController@apply')->name('apply');
    Route::get('applied', 'CouponController@applied')->name('applied');
});

// 管理者
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Auth::routes([
        'register' => false,
        'reset'    => false,
        'vertify'  => false
    ]);
    // ログイン後
    Route::middleware('auth:admin')->group(function () {
        Route::resource('apply', 'ApplyController', ['only' => ['index', 'show']]);
        Route::resource('deadline', 'DeadlineController', ['only' => ['index', 'edit', 'update']]);
        Route::resource('login_history', 'LoginHistoryController', ['only' => ['index']]);
    });
});
