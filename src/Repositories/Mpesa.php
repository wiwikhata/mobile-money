<?php

namespace DervisGroup\Pesa\Repositories;

use DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentRequest;
use DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse;
use DervisGroup\Pesa\Database\Entities\MpesaC2bCallback;
use DervisGroup\Pesa\Database\Entities\MpesaStkCallback;
use DervisGroup\Pesa\Events\B2cPaymentFailedEvent;
use DervisGroup\Pesa\Events\B2cPaymentSuccessEvent;
use DervisGroup\Pesa\Events\C2bConfirmationEvent;
use Gahlawat\Slack\Facade\Slack;
use Illuminate\Support\Facades\Auth;

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
     * @param $response
     * @param array $body
     * @return MpesaBulkPaymentRequest|\Illuminate\Database\Eloquent\Model
     */
    public function saveB2cRequest($response, $body = [])
    {
        return MpesaBulkPaymentRequest::create([
            'conversation_id' => $response->ConversationID,
            'originator_conversation_id' => $response->OriginatorConversationID,
            'amount' => $body['Amount'],
            'phone' => $body['PartyB'],
            'remarks' => $body['Remarks'],
            'CommandID' => $body['CommandID'],
            'user_id' => Auth::id(),
        ]);
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

    /**
     * @return MpesaBulkPaymentResponse
     */
    private function handleB2cResult()
    {
        $data = json_decode(request('Result'), true);
        $common = [
            'ResultType', 'ResultCode', 'ResultDesc', 'OriginatorConversationID', 'ConversationID', 'TransactionID'
        ];
        if ($data['ResultCode'] !== 0) {
            $response = MpesaBulkPaymentResponse::create($data, array_only($data, $common));
            event(new B2cPaymentFailedEvent($response->request, $data));
            return $response;
        }
        $response = MpesaBulkPaymentResponse::create($data, array_except($data, ['ResultParameters', 'ReferenceData']));
        event(new B2cPaymentSuccessEvent($response->request, $data));
        return $response;
    }

    /**
     * @param string|null $initiator
     * @return MpesaBulkPaymentResponse|void
     */
    public function handleResult($initiator = null)
    {
        if ($initiator === 'b2c') {
            return $this->handleB2cResult();
        }
        return;
    }

    /**
     * @param $title
     * @param bool $important
     */
    public function notification($title, $important = false): void
    {
        $slack = config('pesa.notifications.slack_web_hook');
        if (empty($slack)) {
            return;
        }
        if (config('pesa.notifications.only_important') && !$important) {
            return;
        }
        config([
            'slack.incoming-webhook' => config('pesa.notifications.slack_web_hook'),
            'slack.default_username' => 'MPESA',
            'slack.default_emoji' => ':mailbox_with_mail:',]);
        Slack::send($title);
        Slack::send('```' . json_encode(request()->all(), JSON_PRETTY_PRINT) . '```');
    }
}
