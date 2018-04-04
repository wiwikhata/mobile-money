
### STK PUSH REQUEST

Sim Toolkit Request is where you initiate a payment request, the request is then pushed to users phone to validate the transaction by entering their MPESA PIN .

``mpesa_request('07xxxxxxxx',1,'reference','description')``
> MPESA recently allowed transactions of even KES 1.00

This package emits `DervisGroup\Pesa\Events\StkPushPaymentSuccessEvent` if an STK payment was processed successfully. 
If an STK request payment is unsuccessful, it emits `DervisGroup\Pesa\Events\StkPushPaymentFailedEvent`. Both events exposes the initial request model to the registered event handlers.

### Listening for Payments
A nice and efficient way to tap this events is to register a event listener in your EventServiceProvider
````
<?php

namespace Dervis\Providers;

use DervisGroup\Pesa\Events\C2bConfirmationEvent;
use DervisGroup\Pesa\Events\StkPushPaymentFailedEvent;
use DervisGroup\Pesa\Events\StkPushPaymentSuccessEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        C2bConfirmationEvent::class => [
            PaymentConfirmed::class,
        ],
        StkPushPaymentFailedEvent::class => [
            StkPaymentFailed::class,
        ],
        StkPushPaymentSuccessEvent::class => [
            StkPaymentReceived::class,
        ],
    ];
}

````