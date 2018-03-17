<?php

namespace DervisGroup\Pesa\Tests\Unit;

use DervisGroup\Pesa\Mpesa\Library\Authenticator;
use DervisGroup\Pesa\Tests\TestCase;
use GuzzleHttp\ClientInterface;

class CoreTest extends TestCase
{
    /**
     * Test that the authenticator is set.
     *
     * @test
     **/
    public function testAuthSet()
    {
        $this->assertInstanceOf(Authenticator::class, $this->engine->auth);
    }

    /**
     * Test that the http client is set.
     *
     * @test
     **/
    public function testClientSet()
    {
        $this->assertInstanceOf(ClientInterface::class, $this->engine->client);
    }
}