<?php

use DervisGroup\Pesa\Mpesa\Facades\B2C;
use DervisGroup\Pesa\Mpesa\Facades\Identity;
use DervisGroup\Pesa\Mpesa\Facades\STK;

if (!function_exists('mpesa_balance')) {
    /**
     * @return mixed
     */
    function mpesa_balance()
    {
        return B2C::balance();
    }
}
if (!function_exists('mpesa_send')) {
    /**
     * @param string $phone
     * @param int $amount
     * @return mixed
     */
    function mpesa_send($phone, $amount)
    {
        return B2C::send($phone, $amount);
    }
}
if (!function_exists('mpesa_id_check')) {
    /**
     * @param string $phone
     * @return mixed
     */
    function mpesa_id_check($phone)
    {
        return Identity::validate($phone);
    }
}
if (!function_exists('mpesa_request')) {
    /**
     * @param string $phone
     * @param int $amount
     * @param string|null $reference
     * @param string|null $description
     * @return mixed
     */
    function mpesa_request($phone, $amount, $reference = null, $description = null)
    {
        return STK::push($amount, $phone, $reference, $description);
    }
}
