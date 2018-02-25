<?php

namespace DervisGroup\Pesa\Mpesa\Facades;

use Illuminate\Support\Facades\Facade;

class STK extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mpesa_stk';
    }
}
