<?php

namespace Telegram\Handler;

abstract class AbstractHandler implements HandlerInterface
{
    /**
     * @var ActionInterface[]
     */
    protected $events;

    public function on(string $event, ActionInterface $action): HandlerInterface
    {
        $this->events[$event] = $action;

        return $this;
    }
}
