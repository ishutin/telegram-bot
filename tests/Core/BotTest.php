<?php

namespace Test\Core;

use PHPUnit\Framework\TestCase;
use PHPUnit\Runner\Exception;
use Telegram\Bot;
use Telegram\Config;
use Telegram\Event\Event;
use Telegram\Request;
use Telegram\Response;

final class BotTest extends TestCase
{
    /**
     * @var array
     */
    private $testRequest = [
        'update_id' => 1,
        'message' => [
            'message_id' => 1,
            'from' => [
                'id' => 1,
                'is_bot' => false,
                'first_name' => 'Test',
                'last_name' => 'Unit',
                'username' => 'unit_test',
                'language_code' => 'en',
            ],
            'chat' => [
                'id' => 1,
                'first_name' => 'Test',
                'last_name' => 'Unit',
                'username' => 'unit_test',
                'type' => 'private',
            ],
            'date' => 1511091561,
            'text' => 'test text message',
        ],
    ];

    public function testRequest()
    {
        $config = new Config('abc');
        $bot = new Bot($config);
        $request = $bot->getRequest($this->testRequest);

        $this->assertInstanceOf(Request::class, $request);
    }

    public function testResponse()
    {
        $config = new Config('abc');
        $bot = new Bot($config);
        $response = $bot->getResponse();

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAddEvent()
    {
        $config = new Config('abc');
        $bot = new Bot($config);

        $event = new class($bot) extends Event
        {
            public function listen()
            {
            }
        };

        $bot->addEvent($event);
        $result = $bot->run();

        $this->assertTrue($result);
    }
}
