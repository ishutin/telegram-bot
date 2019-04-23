<?php

namespace Telegram\Event;

class EventStorage implements EventStorageInterface
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

    public function getHandler(string $event): ?EventHandlerInterface
    {
        return $this->handlers[$event] ?? null;
    }

    public function on(string $event, EventHandlerInterface $handler): EventStorageInterface
    {
        $this->handlers[$event] = $handler;

        return $this;
    }
}
