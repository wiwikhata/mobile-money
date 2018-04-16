<?php

namespace DervisGroup\Pesa;

use DervisGroup\Pesa\Equity\EquityServiceProvider;
use DervisGroup\Pesa\Mpesa\MpesaServiceProvider;
use Illuminate\Support\ServiceProvider;

class PesaServiceProvider extends ServiceProvider
{
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(MpesaServiceProvider::class);
        $this->app->register(EquityServiceProvider::class);
    }

    public function boot()
    {
        $this->requireHelperScripts();
    }

    private function requireHelperScripts()
    {
        $files = glob(__DIR__ . '/Support/*.php');
        foreach ($files as $file) {
            include_once $file;
        }
    }
}
