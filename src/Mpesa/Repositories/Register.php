<?php

namespace DervisGroup\Pesa\Mpesa\Repositories;

use DervisGroup\Pesa\Mpesa\Library\RegisterUrl;

/**
 * Class Register
 * @package DervisGroup\Pesa\Mpesa\Repositories
 */
class Register
{
    /**
     * @var RegisterUrl
     */
    private $registra;

    /**
     * Register constructor.
     * @param RegisterUrl $registerUrl
     */
    public function __construct(RegisterUrl $registerUrl)
    {
        $this->registra = $registerUrl;
    }

    /**
     * @return mixed
     * @throws \DervisGroup\Pesa\Mpesa\Exceptions\MpesaException
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function doRegister()
    {
        return $this->registra->register(\config('dervisgroup.mpesa.c2b.short_code'))
            ->onConfirmation(\config('dervisgroup.mpesa.c2b.confirmation_url'))
            ->onValidation(\config('dervisgroup.mpesa.c2b.validation_url'))
            ->submit();
    }
}
