<?php

Route::group(['prefix' => 'payments/callbacks', 'middleware' => 'pesa.cors', 'namespace' => 'DervisGroup\Pesa\Http\Controllers'], function () {
    Route::post('validate', 'MpesaController@validatePayment');
    Route::post('confirmation', 'MpesaController@confirmation');
    Route::post('callback', 'MpesaController@confirmation');
    Route::post('stk_callback', 'MpesaController@stkCallback');
    Route::post('timeout_url/{section?}', 'MpesaController@timeout');
    Route::post('result/{section?}', 'MpesaController@result');
    Route::post('stk_request', 'StkController@initiatePush');
    Route::post('stk_status', 'StkController@stkStatus');
});
