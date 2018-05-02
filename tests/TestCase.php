<?php

namespace DervisGroup\Pesa\Tests;

use DervisGroup\Pesa\Mpesa\Facades\B2C;
use DervisGroup\Pesa\Mpesa\Facades\Identity;
use DervisGroup\Pesa\Mpesa\Facades\Registrar;
use DervisGroup\Pesa\Mpesa\Facades\STK;
use DervisGroup\Pesa\PesaServiceProvider;

/**
 * Class TestCase
 * @package DervisGroup\Pesa\Tests
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [PesaServiceProvider::class];
    }

    protected function getPackdageAliases($app)
    {
        return [
            'B2C' => B2C::class,
            'Identity' => Identity::class,
            'Registrar' => Registrar::class,
            'STK' => STK::class,
        ];
    }
}
