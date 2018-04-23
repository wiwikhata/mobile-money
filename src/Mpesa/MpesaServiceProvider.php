<?php

namespace DervisGroup\Pesa\Mpesa;

use DervisGroup\Pesa\Mpesa\Commands\Registra;
use DervisGroup\Pesa\Mpesa\Commands\StkStatus;
use DervisGroup\Pesa\Mpesa\Events\C2bConfirmationEvent;
use DervisGroup\Pesa\Mpesa\Events\StkPushPaymentFailedEvent;
use DervisGroup\Pesa\Mpesa\Events\StkPushPaymentSuccessEvent;
use DervisGroup\Pesa\Mpesa\Http\Middlewares\PesaCors;
use DervisGroup\Pesa\Mpesa\Library\BulkSender;
use DervisGroup\Pesa\Mpesa\Library\Core;
use DervisGroup\Pesa\Mpesa\Library\IdCheck;
use DervisGroup\Pesa\Mpesa\Library\RegisterUrl;
use DervisGroup\Pesa\Mpesa\Library\StkPush;
use DervisGroup\Pesa\Mpesa\Listeners\C2bPaymentConfirmation;
use DervisGroup\Pesa\Mpesa\Listeners\StkPaymentFailed;
use DervisGroup\Pesa\Mpesa\Listeners\StkPaymentSuccessful;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

/**
 * Class MpesaServiceProvider
 * @package DervisGroup\Pesa\Mpesa
 */
class MpesaServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     * @throws Exceptions\MpesaException
     */
    public function register()
    {
        $core = new Core(new Client(['http_errors' => false,]));
        $this->app->bind(Core::class, function () use ($core) {
            return $core;
        });
        $this->commands(
            [
                Registra::class,
                StkStatus::class,
            ]
        );

        $this->registerFacades();
        $this->registerEvents();
        $this->mergeConfigFrom(__DIR__ . '/../../config/dervisgroup.mpesa.php', 'dervisgroup.mpesa');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->publishes([__DIR__ . '/../../config/dervisgroup.mpesa.php' => config_path('dervisgroup.mpesa.php'),]);

        $this->app['router']->aliasMiddleware('pesa.cors', PesaCors::class);
    }

    /**
     * Register facade accessors
     */
    private function registerFacades()
    {
        $this->app->bind(
            'mpesa_stk', function () {
            return $this->app->make(StkPush::class);
        }
        );
        $this->app->bind(
            'mpesa_registrar', function () {
            return $this->app->make(RegisterUrl::class);
        }
        );
        $this->app->bind(
            'mpesa_identity', function () {
            return $this->app->make(IdCheck::class);
        }
        );
        $this->app->bind(
            'mpesa_b2c', function () {
            return $this->app->make(BulkSender::class);
        }
        );
    }

    /**
     * Register events
     */
    private function registerEvents()
    {
        Event::listen(StkPushPaymentSuccessEvent::class, StkPaymentSuccessful::class);
        Event::listen(StkPushPaymentFailedEvent::class, StkPaymentFailed::class);
        Event::listen(C2bConfirmationEvent::class, C2bPaymentConfirmation::class);
    }
}
