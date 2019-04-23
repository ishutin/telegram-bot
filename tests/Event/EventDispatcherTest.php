<?php

namespace Test\Event;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;
use Telegram\Entity\Update;
use Telegram\Event\EventDispatcher;
use Telegram\Event\EventHandlerInterface;
use Telegram\Event\EventStorage;
use Telegram\Http\RequestInterface;

final class EventDispatcherTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testGetHandlers(): void
    {
        $storage = new EventStorage();
        $storage->on($storage::EVENT_MESSAGE, $this->getHandlerInstance());
        $update = new Update(1);
        $update->setMessage(new Message(1, 1, new Chat(1, 'chat-type')));

        $dispatcher = new EventDispatcher($storage);

        $class = new ReflectionClass($dispatcher);
        $method = $class->getMethod('getHandlers');
        $method->setAccessible(true);

        $this->assertNotEmpty($method->invokeArgs($dispatcher, [$update]));
    }

    private function getHandlerInstance(): EventHandlerInterface
    {
        return new class implements EventHandlerInterface
        {
            public function handle(RequestInterface $request, Update $update): void
            {
            }
        };
    }
}
