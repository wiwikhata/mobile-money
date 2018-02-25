<?php

namespace DervisGroup\Pesa\Http\Controllers;

use Gahlawat\Slack\Facade\Slack;

class MpesaController extends Controller
{
    public function timeout($initiator)
    {
        Slack::send('Queue timeout: *' . $initiator . '*');
        Slack::send('```' . json_encode(request()->all(), JSON_PRETTY_PRINT) . '```');
        return response()->json(
            [
            'ResponseCode' => '00000000',
            'ResponseDesc' => 'success'
            ]
        );
    }

    public function result($initiator)
    {
        Slack::send('Incoming result: *' . $initiator . '*');
        Slack::send('```' . json_encode(request()->all(), JSON_PRETTY_PRINT) . '```');
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
        Slack::send('Incoming payment callback: *' . $initiator . '*');
        Slack::send('```' . json_encode(request()->all(), JSON_PRETTY_PRINT) . '```');
        return response()->json(
            [
            'ResponseCode' => '00000000',
            'ResponseDesc' => 'success'
            ]
        );
    }
}
