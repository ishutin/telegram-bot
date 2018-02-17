<?php

namespace Telegram\Handler;

abstract class AbstractEventHandler implements EventHandlerInterface
{
    /**
     * @var EventInterface[]
     */
    protected $events;

    public function on(string $event, EventInterface $action): EventHandlerInterface
    {
        $this->events[$event] = $action;

        return $this;
    }
}
