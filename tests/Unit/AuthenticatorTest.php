<?php

namespace DervisGroup\Pesa\Tests\Unit;


use DervisGroup\Pesa\Exceptions\MpesaException;
use DervisGroup\Pesa\Mpesa\Library\Authenticator;
use DervisGroup\Pesa\Mpesa\Library\Core;
use DervisGroup\Pesa\Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class AuthenticatorTest extends TestCase
{
    protected $config;
    protected $cache;

    /**
     * Test that authenticator works.
     *
     * @test
     *
     * @throws \DervisGroup\Pesa\Exceptions\MpesaException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testAuthentication()
    {
        $mock = new MockHandler([
            new Response(202, [], \json_encode(['access_token' => 'access', 'expires_in' => 3599])),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $engine = new Core($client);
        $auth = new Authenticator($engine);
        $token = $auth->authenticate();
        $this->assertEquals('access', $token);
    }

    /**
     * Test that authenticator works.
     *
     * @test
     *
     * @throws MpesaException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testAuthenticationFailure()
    {
        $this->expectException(MpesaException::class);
        $mock = new MockHandler([
            new Response(400, [], \json_encode([]), null, 'Bad Request: Invalid Credentials'),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $engine = new Core($client);
        $auth = new Authenticator($engine);
        $auth->authenticate();
    }
}