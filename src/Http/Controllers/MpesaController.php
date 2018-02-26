<?php

namespace DervisGroup\Pesa\Http\Controllers;

use DervisGroup\Pesa\Repositories\Mpesa;
use Gahlawat\Slack\Facade\Slack;
use Illuminate\Http\Request;

class MpesaController extends Controller
{
    /**
     * @var Mpesa
     */
    private $repository;

    public function __construct(Mpesa $repository)
    {
        $this->repository = $repository;
    }

    private function notification($title, $important = false)
    {
        $slack = config('pesa.notifications.slack_web_hook');
        if (empty($slack)) {
            return;
        }
        if (config('pesa.notifications.only_important') && !$important) {
            return;
        }
        Slack::send('Queue timeout: *' . $title . '*');
        Slack::send('```' . json_encode(request()->all(), JSON_PRETTY_PRINT) . '```');
    }

    public function timeout($initiator = null)
    {
        $this->notification('Queue timeout: *' . $initiator . '*');
        return response()->json(
            [
                'ResponseCode' => '00000000',
                'ResponseDesc' => 'success'
            ]
        );
    }

    public function result($initiator = null)
    {
        $this->notification('Incoming result: *' . $initiator . '*');
        //        $this->repository->handleResult($initiator);
        return response()->json(
            [
                'ResponseCode' => '00000000',
                'ResponseDesc' => 'success'
            ]
        );
    }

    public function paymentCallback($initiator)
    {
        $this->notification('Incoming payment callback: *' . $initiator . '*');
        return response()->json(
            [
                'ResponseCode' => '00000000',
                'ResponseDesc' => 'success'
            ]
        );
    }

    public function confirmation(Request $request)
    {
        $this->notification('MPESA Confirmation: *C2B*', true);
        $this->repository->processConfirmation(json_encode($request->all()));
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'Confirmation received successfully',
        ];
        return response()->json($resp);
    }

    public function callback()
    {
        $this->notification('MPESA Callback: *C2B*', true);
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'Callback received successfully',
        ];
        return response()->json($resp);
    }

    public function stkCallback(Request $request)
    {
        $this->notification('MPESA STK Callback: *C2B*', true);
        $this->repository->processStkPushCallback(json_encode($request->all()));
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'STK Callback received successfully',
        ];
        return response()->json($resp);
    }

    public function validatePayment(Request $request)
    {
        $this->notification('MPESA Validate Payment URL: *C2B*');
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'Validation passed successfully',
        ];
        return response()->json($resp);
    }
}
