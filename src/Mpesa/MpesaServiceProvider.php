<?php

namespace DervisGroup\Pesa\Mpesa;

use DervisGroup\Pesa\Commands\StkStatus;
use DervisGroup\Pesa\Events\C2bConfirmationEvent;
use DervisGroup\Pesa\Events\StkPushPaymentFailedEvent;
use DervisGroup\Pesa\Events\StkPushPaymentSuccessEvent;
use DervisGroup\Pesa\Listeners\C2bPaymentConfirmation;
use DervisGroup\Pesa\Listeners\StkPaymentFailed;
use DervisGroup\Pesa\Listeners\StkPaymentSuccessful;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use DervisGroup\Pesa\Commands\Registra;
use DervisGroup\Pesa\Mpesa\Library\BulkSender;
use DervisGroup\Pesa\Mpesa\Library\Core;
use DervisGroup\Pesa\Mpesa\Library\IdCheck;
use DervisGroup\Pesa\Mpesa\Library\RegisterUrl;
use DervisGroup\Pesa\Mpesa\Library\StkPush;

/**
 * Class MpesaServiceProvider
 * @package DervisGroup\Pesa\Mpesa
 */
class MpesaServiceProvider extends ServiceProvider
{
    /**
     * @throws \DervisGroup\Pesa\Exceptions\MpesaException
     */
    public function register()
    {
        $core = new Core(new Client());
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
