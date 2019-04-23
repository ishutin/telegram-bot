<?php

namespace Telegram\Event;

class Storage implements StorageInterface
{
    /**
     * @var EventHandlerInterface[]
     */
    private $handlers = [];

    /**
     * @inheritDoc
     */
    public function getHandlers(): array
    {
        return $this->handlers;
    }

    public function on(string $event, EventHandlerInterface $handler): StorageInterface
    {
        $this->handlers[$event] = $handler;

        return $this;
    }
}
