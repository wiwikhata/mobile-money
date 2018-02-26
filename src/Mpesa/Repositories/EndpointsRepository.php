<?php

namespace DervisGroup\Pesa\Mpesa\Repositories;

use DervisGroup\Pesa\Exceptions\MpesaException;

/**
 * Class EndpointsRepository
 *
 * @package DervisGroup\Pesa\Mpesa\Repositories
 */
class EndpointsRepository
{
    /**
     * @var EndpointsRepository
     */
    private static $instance;
    /**
     * @var string
     */
    protected $baseEndpoint;

    /**
     * EndpointsRepository constructor.
     */
    public function __construct()
    {
        $this->baseEndpoint = 'https://api.safaricom.co.ke/';
        $this->setInstance();
    }

    /**
     *
     */
    private function setInstance()
    {
        self::$instance = $this;
    }

    /**
     * @return EndpointsRepository
     */
    public static function getInstance()
    {
        return self::$instance;
    }

    /**
     * @param string $section
     * @return string
     * @throws MpesaException
     */
    private static function getEndpoint($section)
    {
        switch ($section) {
            case 'auth':
                return 'oauth/v1/generate?grant_type=client_credentials';
            case 'id_check':
                return 'mpesa/checkidentity/v1/query';
            case 'register':
                return 'mpesa/c2b/v1/registerurl';
            case 'stk_push':
                return 'mpesa/stkpush/v1/processrequest';
            case 'stk_status':
                return 'mpesa/stkpushquery/v1/query';
            case 'b2c':
                return 'mpesa/b2c/v1/paymentrequest';
            case 'transaction_status':
                return 'mpesa/transactionstatus/v1/query';
            case 'account_balance':
                return 'mpesa/accountbalance/v1/query';
            case 'b2b':
                return 'mpesa/b2b/v1/paymentrequest';
            default:
                throw new MpesaException('Unknown Endpoint');
        }
    }

    /**
     * @param $endpoint
     * @return string
     * @throws MpesaException
     */
    public static function build($endpoint)
    {
        $instance = self::$instance;
        $endpoint = $instance->getEndpoint($endpoint);
        return $instance->baseEndpoint . $endpoint;
    }
}
