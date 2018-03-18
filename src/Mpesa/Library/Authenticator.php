<?php

namespace DervisGroup\Pesa\Mpesa\Library;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use DervisGroup\Pesa\Exceptions\MpesaException;
use DervisGroup\Pesa\Mpesa\Repositories\EndpointsRepository;

/**
 * Class Authenticator
 *
 * @package DervisGroup\Pesa\Mpesa\Library
 */
class Authenticator
{

    /**
     * @var string
     */
    protected $endpoint;
    /**
     * @var Core
     */
    protected $engine;
    /**
     * @var Authenticator
     */
    protected static $instance;
    /**
     * @var bool
     */
    public $alt = false;

    /**
     * Authenticator constructor.
     *
     * @param  Core $core
     * @throws MpesaException
     */
    public function __construct(Core $core)
    {
        $this->engine = $core;
        $this->endpoint = EndpointsRepository::build('auth');
        self::$instance = $this;
    }

    /**
     * @param bool $bulk
     * @return string
     * @throws MpesaException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function authenticate($bulk = false)
    {
        if ($bulk) {
            $this->alt = true;
        }
        try {
            $response = $this->makeRequest();
            if ($response->getStatusCode() === 200) {
                $body = \json_decode($response->getBody());
                return $body->access_token;
            }
            throw new MpesaException($response->getReasonPhrase());
        } catch (RequestException $exception) {
            $message = $exception->getResponse() ?
                $exception->getResponse()->getReasonPhrase() :
                $exception->getMessage();

            throw $this->generateException($message);
        }
    }

    /**
     * @param $reason
     * @return MpesaException
     */
    private function generateException($reason)
    {
        switch (\strtolower($reason)) {
            case 'bad request: invalid credentials':
                return new MpesaException('Invalid consumer key and secret combination');
            default:
                return new MpesaException($reason);
        }
    }

    /**
     * @return string
     */
    private function generateCredentials()
    {
        $key = \config('pesa.c2b.consumer_key');
        $secret = \config('pesa.c2b.consumer_secret');
        if ($this->alt) {
            //lazy way to switch to a different app in case of bulk
            $key = \config('pesa.bulk.consumer_key');
            $secret = \config('pesa.bulk.consumer_secret');
        }
        return \base64_encode($key . ':' . $secret);
    }

    /**
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function makeRequest()
    {
        $credentials = $this->generateCredentials();
        return $this->engine->client->request(
            'GET', $this->endpoint, [
                'headers' => [
                    'Authorization' => 'Basic ' . $credentials,
                    'Content-Type' => 'application/json',
                ],
            ]
        );
    }
}
