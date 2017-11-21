<?php

namespace Test\Core;

use PHPUnit\Framework\TestCase;
use Telegram\Bot;
use Telegram\Config;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;
use Telegram\Handler\Handler;
use Telegram\RequestInterface;
use Telegram\Response;

final class BotTest extends TestCase
{
    public function testRequest(): void
    {
        $config = new Config('abc');

        $bot = new Bot($config);

        $bot->initRequest(new class implements RequestInterface
        {
            public function getMessage(): Message
            {
                return new Message(1, 1, new Chat(1, 'private'));
            }
        });

        $this->assertInstanceOf(RequestInterface::class, $bot->getRequest());
    }

    public function testResponse(): void
    {
        $config = new Config('abc');
        $bot = new Bot($config);
        $response = $bot->getResponse();

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAddEvent(): void
    {
        $config = new Config('abc');
        $bot = new Bot($config);

        $event = new class($bot) extends Handler
        {
            public function listen(): void
            {
            }
        };

        $bot->pushHandler($event);
        $result = $bot->run();

        $this->assertTrue($result);
    }
}
