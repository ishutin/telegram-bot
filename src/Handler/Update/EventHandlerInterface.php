<?php

namespace Telegram\Handler\Update;

use Telegram\Entity\Update;
use Telegram\Kernel\RequestInterface;

interface EventHandlerInterface
{
    public function handle(RequestInterface $request, Update $update): void;
}
