<?php

namespace DervisGroup\Pesa\Database\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentRequest
 *
 * @property int $id
 * @property string $conversation_id
 * @property string $originator_conversation_id
 * @property float $amount
 * @property string $phone
 * @property string|null $remarks
 * @property string $CommandID
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentRequest whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentRequest whereCommandID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentRequest whereConversationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentRequest whereOriginatorConversationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentRequest wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentRequest whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\DervisGroup\Pesa\Database\Entities\MpesaBulkPaymentRequest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MpesaBulkPaymentRequest extends Model
{
    protected $guarded = [];
}
