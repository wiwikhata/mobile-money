<?php

namespace DervisGroup\Pesa\Mpesa\Facades;

use Illuminate\Support\Facades\Facade;

class Identity extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mpesa_identity';
    }
}
