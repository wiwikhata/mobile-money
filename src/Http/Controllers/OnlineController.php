<?php

namespace DervisGroup\Pesa\Http\Controllers;

use Illuminate\Http\Request;
use DervisGroup\Pesa\Mpesa\Library\RegisterUrl;
use DervisGroup\Pesa\Repositories\Mpesa;

class OnlineController extends Controller
{
    private $repository;

    public function __construct(Mpesa $repository)
    {
        $this->repository = $repository;
    }

    public function confirmation(Request $request)
    {
        \Slack::send('MPESA Confirmation: *C2B*');
        \Slack::send(json_encode($request->all(), JSON_PRETTY_PRINT));
        $this->repository->processConfirmation(json_encode($request->all()));
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'Confirmation received successfully',
        ];
        return response()->json($resp);
    }

    public function callback(Request $request)
    {
        \Slack::send('MPESA Callback: *C2B*');
        \Slack::send(json_encode($request->all(), JSON_PRETTY_PRINT));
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'Callback received successfully',
        ];
        return response()->json($resp);
    }

    public function stkCallback(Request $request)
    {
        \Slack::send('MPESA STK Callback: *C2B*');
        \Slack::send(json_encode($request->all(), JSON_PRETTY_PRINT));
        $this->repository->processStkPushCallback($request->Body);
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'STK Callback received successfully',
        ];
        return response()->json($resp);
    }

    public function stkTestCallback(Request $request)
    {
        \Slack::send('MPESA STK `Test` Callback: *C2B*');
        \Slack::send(json_encode($request->all(), JSON_PRETTY_PRINT));
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'STK test callback received successfully',
        ];
        return response()->json($resp);
    }

    public function validatePayment(Request $request)
    {
        \Slack::send('MPESA Validate Payment URL: *C2B*');
        \Slack::send(json_encode($request->all(), JSON_PRETTY_PRINT));
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'Validation passed successfully',
        ];
        return response()->json($resp);
    }
}
