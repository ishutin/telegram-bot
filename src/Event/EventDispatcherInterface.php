<?php

namespace Telegram\Event;

use Telegram\Entity\Update;
use Telegram\Kernel\RequestInterface;

interface EventDispatcherInterface
{
    /**
     * @param RequestInterface $request
     * @param Update $update
     */
    public function dispatch(RequestInterface $request, Update $update): void;
}