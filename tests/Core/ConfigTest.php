<?php

namespace Test\Core;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\TestCase;
use Telegram\Config;

final class ConfigTest extends TestCase
{
    public function testToken(): void
    {
        $config = new Config('abc');
        $this->assertEquals($config->getToken(), 'abc');
    }

    public function testHttpClient(): void
    {
        $config = new Config('abc');
        $this->assertNull($config->getHttpClient());

        $client = new Client();
        $config->setHttpClient($client);
        $this->assertInstanceOf(
            ClientInterface::class,
            $config->getHttpClient()
        );

        $this->assertEquals($client, $config->getHttpClient());
    }
}
