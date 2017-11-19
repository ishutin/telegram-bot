<?php

namespace Test\Core;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Telegram\Config;

final class ConfigTest extends TestCase
{
    public function testToken()
    {
        $config = new Config('abc');
        $this->assertEquals($config->getToken(), 'abc');
    }

    public function testHttpClient()
    {
        $config = new Config('abc');
        $this->assertNull($config->getHttpClient());

        $client = new Client();
        $config->setHttpClient($client);

        $this->assertEquals($client, $config->getHttpClient());
    }
}
