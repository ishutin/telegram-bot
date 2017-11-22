<?php

namespace Test\Core;

use PHPUnit\Framework\TestCase;
use Telegram\Handler\HandlerInterface;
use Telegram\Kernel;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;
use Telegram\RequestInterface;
use Telegram\Response;
use Telegram\ResponseInterface;

final class KernelTest extends TestCase
{
    public function testRequest(): void
    {
        $request = new class implements RequestInterface {
            public function getMessage(): Message
            {
                return new Message(1, 1, new Chat(1, 'private'));
            }
        };

        $response = new Response('xxxx-xxxx-xxxx-xxxx');

        $kernel = new Kernel($request, $response);

        $this->assertInstanceOf(ResponseInterface::class, $kernel->getResponse());
        $this->assertInstanceOf(RequestInterface::class, $kernel->getRequest());
    }

    public function testAddEvent(): void
    {
        $request = new class implements RequestInterface {
            public function getMessage(): Message
            {
                return new Message(1, 1, new Chat(1, 'private'));
            }
        };

        $response = new Response('xxxx-xxxx-xxxx-xxxx');

        $kernel = new Kernel($request, $response);

        $event = new class implements HandlerInterface
        {
            public function handle(RequestInterface $request, ResponseInterface $response): void
            {
            }
        };

        $kernel->pushHandler($event);
        $result = $kernel->run();

        $this->assertTrue($result);
    }
}
