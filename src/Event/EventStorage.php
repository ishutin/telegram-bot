<?php

namespace Telegram\Event;

class EventStorage implements EventStorageInterface
{
    /**
     * @var EventHandlerInterface[][]
     */
    private $handlers = [];

    /**
     * @inheritDoc
     */
    public function getHandlers(string $event): array
    {
        return $this->handlers[$event] ?? [];
    }

    public function on(string $event, EventHandlerInterface $handler): EventStorageInterface
    {
        if (!isset($this->handlers[$event])) {
            $this->handlers[$event] = [];
        }

        $this->handlers[$event][] = $handler;

        return $this;
    }
}
