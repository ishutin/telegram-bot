<?php

namespace Telegram\Event;

use Telegram\Entity\Update;
use Telegram\Kernel\RequestInterface;

interface EventHandlerInterface
{
    /**
     * @param RequestInterface $request
     * @param Update $update
     */
    public function handle(RequestInterface $request, Update $update): void;
}