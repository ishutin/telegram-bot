<?php

namespace Telegram\Handler;

abstract class AbstractHandler implements HandlerInterface
{
    /**
     * @var ActionInterface
     */
    protected $action;

    public function __construct(ActionInterface $action)
    {
        $this->action = $action;
    }
}
