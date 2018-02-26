<?php

namespace DervisGroup\Pesa\Http\Controllers;

use DervisGroup\Pesa\Mpesa\Facades\STK;
use Illuminate\Http\Request;

class StkController extends Controller
{
    public function initiatePush(Request $request)
    {
        try {
            $push = STK::request($request->amount)
                ->from($request->phone)
                ->usingReference($request->reference, $request->description)
                ->push();
        } catch (\Exception $exception) {
            $push = ['ResponseCode' => 900, 'ResponseDescription' => 'Invalid request', 'extra' => $exception->getMessage()];
        }
        return response()->json($push);
    }

    public function stkStatus($request_ref)
    {
        return response()->json(STK::validate($request_ref));
    }
}
