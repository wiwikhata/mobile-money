<?php

namespace DervisGroup\Pesa\Tests;

use DervisGroup\Pesa\Mpesa\Library\Core;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7;
use Mockery;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Core
     */
    protected $engine;

    /**
     * @throws \DervisGroup\Pesa\Exceptions\MpesaException
     */
    public function setUp()
    {
        $client = Mockery::mock(ClientInterface::class);
        $promise = new Psr7\Response();
        $client->shouldReceive('request')->andReturn($promise);
        $this->engine = new Core($client);
    }
}
