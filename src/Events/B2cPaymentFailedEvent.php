<?php

namespace DervisGroup\Pesa\Events;


use DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentRequest;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class B2cPaymentFailedEvent
 * @package DervisGroup\Pesa\Events
 */
class B2cPaymentFailedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var MpesaBulkPaymentRequest
     */
    public $bulkPaymentRequest;
    /**
     * @var array
     */
    public $response;

    /**
     * B2cPaymentSuccessEvent constructor.
     * @param MpesaBulkPaymentRequest $request
     * @param array $response
     */
    public function __construct(MpesaBulkPaymentRequest $request, $response)
    {
        $this->bulkPaymentRequest = $request;
        $this->response = $response;
    }
}