<?php

Route::group(['prefix' => 'payments/callbacks', 'middleware' => 'pesa.cors','namespace'=>'DervisGroup\Pesa\Http\Controllers'], function () {
    Route::any('validate', 'OnlineController@validatePayment');
    Route::any('confirmation', 'OnlineController@confirmation');
    Route::any('callback', 'OnlineController@confirmation');
    Route::any('stk_callback', 'OnlineController@stkCallback');
    Route::any('stk_test_callback', 'OnlineController@stkTestCallback');
    Route::post('stk_request', 'StkController@initiatePush');
    Route::post('stk_status', 'StkController@stkStatus');
    Route::any('timeout_url', 'StkController@stkStatus');
    Route::any('result', 'StkController@stkStatus');
});
