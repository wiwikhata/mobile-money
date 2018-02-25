<?php

namespace DervisGroup\Pesa\Mpesa\Library;

use Carbon\Carbon;
use DervisGroup\Pesa\Exceptions\MpesaException;
use DervisGroup\Pesa\Repositories\Generator;

class StkPush extends ApiCore
{
    /**
     * @var string
     */
    protected $number;
    /**
     * @var int
     */
    protected $amount;
    /**
     * @var string
     */
    protected $reference;
    /**
     * @var string
     */
    protected $description;

    /**
     * @param string $amount
     * @return $this
     * @throws MpesaException
     */
    public function request($amount)
    {
        if (!\is_numeric($amount)) {
            throw new MpesaException('The amount must be numeric');
        }
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string $number
     * @return $this
     */
    public function from($number)
    {
        $this->number = $this->formatPhoneNumber($number);
        return $this;
    }

    /**
     * Set the mpesa reference
     *
     * @param  string $reference
     * @param  string $description
     * @return $this
     * @throws MpesaException
     */
    public function usingReference($reference, $description)
    {
        \preg_match('/[^A-Za-z0-9]/', $reference, $matches);
        if (\count($matches)) {
            throw new MpesaException('Reference should be alphanumeric.');
        }
        $this->reference = $reference;
        $this->description = $description;
        return $this;
    }

    /**
     * Send a payment request
     *
     * @param  null|int $amount
     * @param  null|string $number
     * @param  null|string $reference
     * @param  null|string $description
     * @return mixed
     * @throws \DervisGroup\Pesa\Exceptions\MpesaException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function push($amount = null, $number = null, $reference = null, $description = null)
    {
        $time = Carbon::now()->format('YmdHis');
        $shortCode = config('pesa.c2b.short_code');
        $passkey = config('pesa.c2b.passkey');
        $callback = config('pesa.c2b.stk_callback');
        $password = \base64_encode($shortCode . $passkey . $time);
        $good_phone = $this->formatPhoneNumber($number ?: $this->number);
        $body = [
            'BusinessShortCode' => $shortCode,
            'Password' => $password,
            'Timestamp' => $time,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount ?: $this->amount,
            'PartyA' => $good_phone,
            'PartyB' => $shortCode,
            'PhoneNumber' => $good_phone,
            'CallBackURL' => $callback,
            'AccountReference' => $reference ?? $this->reference ?? $good_phone,
            'TransactionDesc' => $description ?? $this->description ?? Generator::generateTransactionNumber(),
        ];
        return $this->sendRequest($body, 'stk_push');
    }
}
