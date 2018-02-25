<?php

namespace DervisGroup\Pesa;

use Illuminate\Support\ServiceProvider;
use DervisGroup\Pesa\Http\Middlewares\PesaCors;
use DervisGroup\Pesa\Mpesa\MpesaServiceProvider;

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
        $this->mergeConfigFrom(__DIR__ . '/../config/pesa.php', 'pesa');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->publishes([__DIR__ . '/../config/pesa.php' => config_path('pesa.php'),]);
        $this->requireHelperScripts();
        $this->app['router']->aliasMiddleware('pesa.cors', PesaCors::class);
    }

    private function requireHelperScripts()
    {
        $files = glob(__DIR__ . '/Support/*.php');
        foreach ($files as $file) {
            include_once $file;
        }
    }
}
