<?php

namespace DervisGroup\Pesa\Repositories;

use DervisGroup\Pesa\Database\Entities\MpesaC2bCallback;
use DervisGroup\Pesa\Database\Entities\MpesaStkCallback;
use DervisGroup\Pesa\Events\C2bConfirmationEvent;

/**
 * Class Mpesa
 * @package DervisGroup\Pesa\Repositories
 */
class Mpesa
{
    /**
     * @param string $json
     * @return $this|array|\Illuminate\Database\Eloquent\Model
     */
    public function processStkPushCallback($json)
    {
        $object = json_decode($json);
        $data = $object->stkCallback;
        $real_data = [
            'MerchantRequestID' => $data->MerchantRequestID,
            'CheckoutRequestID' => $data->CheckoutRequestID,
            'ResultCode' => $data->ResultCode,
            'ResultDesc' => $data->ResultDesc,
        ];
        if ($data->ResultCode == 0) {
            $_payload = $data->CallbackMetadata->Item;
            foreach ($_payload as $item) {
                $real_data[$item->Name] = @$item->Value;
            }
            return MpesaStkCallback::create($real_data);
        }
        return $real_data;
    }

    /**
     * @param string $json
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function processConfirmation($json)
    {
        $data = json_decode($json, true);
        $callback = MpesaC2bCallback::create($data);
        event(new C2bConfirmationEvent($callback));
        return $callback;
    }
}
