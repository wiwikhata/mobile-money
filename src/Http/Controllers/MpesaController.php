<?php

namespace DervisGroup\Pesa\Http\Controllers;

use DervisGroup\Pesa\Repositories\Mpesa;
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
        $this->repository->notification('Incoming result: *' . $initiator . '*');
        $this->repository->handleResult($initiator);
        return response()->json(
            [
                'ResponseCode' => '00000000',
                'ResponseDesc' => 'success'
            ]
        );
    }

    public function paymentCallback($initiator)
    {
        $this->repository->notification('Incoming payment callback: *' . $initiator . '*');
        return response()->json(
            [
                'ResponseCode' => '00000000',
                'ResponseDesc' => 'success'
            ]
        );
    }

    public function confirmation(Request $request)
    {
        $this->repository->notification('MPESA Confirmation: *C2B*', true);
        $this->repository->processConfirmation(json_encode($request->all()));
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'Confirmation received successfully',
        ];
        return response()->json($resp);
    }

    public function callback()
    {
        $this->repository->notification('MPESA Callback: *C2B*', true);
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'Callback received successfully',
        ];
        return response()->json($resp);
    }

    public function stkCallback(Request $request)
    {
        $this->repository->notification('MPESA STK Callback: *C2B*', true);
        $this->repository->processStkPushCallback(json_encode($request->Body));
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'STK Callback received successfully',
        ];
        return response()->json($resp);
    }

    public function validatePayment()
    {
        $this->repository->notification('MPESA Validate Payment URL: *C2B*');
        $resp = [
            'ResultCode' => 0,
            'ResultDesc' => 'Validation passed successfully',
        ];
        return response()->json($resp);
    }
}
