<?php

namespace DervisGroup\Pesa\Mpesa\Facades;

use Illuminate\Support\Facades\Facade;

class B2C extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mpesa_b2c';
    }
}
