<?php

namespace DervisGroup\Pesa\Repositories;

use Illuminate\Http\Request;
use DervisGroup\Pesa\Database\Entities\MpesaC2bCallback;
use DervisGroup\Pesa\Database\Entities\MpesaStkCallback;
use DervisGroup\Pesa\Database\Entities\MpesaStkRequest;

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
        return MpesaC2bCallback::create($data);
    }

    /**
     * @param Request $request
     * @param array $data
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function createStk(Request $request, $data = [])
    {
        $incoming = !empty($data) ? $data : $request->all();
        $this->formatPhoneNumber($incoming['phone']);
        return MpesaStkRequest::create($incoming);
    }

    /**
     * @param string $number
     * @param bool $strip_plus
     * @return null|string|string[]
     */
    private function formatPhoneNumber(&$number, $strip_plus = true)
    {
        $number = preg_replace('/\s+/', '', $number);
        $replace = function ($needle, $replacement) use (&$number) {
            if (starts_with($number, $needle)) {
                $pos = strpos($number, $needle);
                $length = strlen($needle);
                $number = substr_replace($number, $replacement, $pos, $length);
            }
        };
        $replace('2547', '+2547');
        $replace('07', '+2547');
        if ($strip_plus) {
            $replace('+254', '254');
        }
        return $number;
    }
}
