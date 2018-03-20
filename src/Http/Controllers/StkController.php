<?php

namespace DervisGroup\Pesa\Http\Controllers;

use DervisGroup\Pesa\Events\StkPushRequestedEvent;
use DervisGroup\Pesa\Mpesa\Facades\STK;
use Illuminate\Http\Request;

class StkController extends Controller
{
    public function initiatePush(Request $request)
    {
        try {
            $stk = STK::request($request->amount)
                ->from($request->phone)
                ->usingReference($request->reference, $request->description)
                ->push();
            event(new StkPushRequestedEvent($stk));
        } catch (\Exception $exception) {
            $stk = ['ResponseCode' => 900, 'ResponseDescription' => 'Invalid request', 'extra' => $exception->getMessage()];
        }
        return response()->json($stk);
    }

    public function stkStatus($id)
    {
        return response()->json(STK::validate($id));
    }
}
