<?php

namespace DervisGroup\Pesa\Mpesa\Events;


use DervisGroup\Pesa\Database\Entities\MpesaStkRequest;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class StkPushRequested
 * @package DervisGroup\Pesa\Mpesa\Events
 */
class StkPushRequested
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var MpesaStkRequest
     */
    public $stk;

    /**
     * StkPushRequested constructor.
     * @param MpesaStkRequest $mpesaStkRequest
     */
    public function __construct(MpesaStkRequest $mpesaStkRequest)
    {
        $this->stk = $mpesaStkRequest;
    }
}