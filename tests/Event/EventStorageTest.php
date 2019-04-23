<?php

namespace Test\Event;

use PHPUnit\Framework\TestCase;
use Telegram\Entity\Update;
use Telegram\Event\EventHandlerInterface;
use Telegram\Event\EventStorage;
use Telegram\Http\RequestInterface;

final class EventStorageTest extends TestCase
{
    public function testBase(): void
    {
        $handler1 = $this->getHandlerInstance();
        $handler2 = $this->getHandlerInstance();
        $handler3 = $this->getHandlerInstance();
        $handler4 = $this->getHandlerInstance();


        $storage = new EventStorage();

        $storage->on('a', $handler1);
        $storage->on('a', $handler2);
        $storage->on('a', $handler3);
        $storage->on('a', $handler4);

        $storage->on('b', $handler3);
        $storage->on('b', $handler4);

        $this->assertEquals(
            [$handler1, $handler2, $handler3, $handler4],
            $storage->getHandlers('a')
        );

        $this->assertEquals(
            [$handler3, $handler4],
            $storage->getHandlers('b')
        );
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
