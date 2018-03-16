<?php

namespace DervisGroup\Pesa\Mpesa\Events;


use DervisGroup\Pesa\Database\Entities\MpesaC2bCallback;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class C2bConfirmation
 * @package DervisGroup\Pesa\Mpesa\Events
 */
class C2bConfirmation
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var
     */
    public $transaction;

    /**
     * C2bConfirmation constructor.
     * @param MpesaC2bCallback $c2bCallback
     */
    public function __construct(MpesaC2bCallback $c2bCallback)
    {
        $this->transaction = $c2bCallback;
    }
}