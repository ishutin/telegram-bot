<?php

namespace Telegram\Event;

use Telegram\Entity\Update\Update;
use Telegram\Http\RequestInterface;

interface EventHandlerInterface
{
    public function handle(RequestInterface $request, Update $update): void;
}
