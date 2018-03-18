<?php

namespace DervisGroup\Pesa\Database\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse
 *
 * @property int $id
 * @property int $ResultType
 * @property int $ResultCode
 * @property string $ResultDesc
 * @property string $OriginatorConversationID
 * @property string $ConversationID
 * @property string $TransactionID
 * @property float|null $TransactionAmount
 * @property string|null $ReceiverPartyPublicName
 * @property string|null $TransactionCompletedDateTim
 * @property float|null $B2CUtilityAccountAvailableFunds
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentRequest $request
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse whereB2CUtilityAccountAvailableFunds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse whereConversationID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse whereOriginatorConversationID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse whereReceiverPartyPublicName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse whereResultCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse whereResultDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse whereResultType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse whereTransactionAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse whereTransactionCompletedDateTim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse whereTransactionID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentResponse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MpesaBulkPaymentResponse extends Model
{
    protected $guarded = [];

    public function request()
    {
        return $this->belongsTo(MpesaBulkPaymentRequest::class, 'ConversationID', 'ConversationID');
    }
}
