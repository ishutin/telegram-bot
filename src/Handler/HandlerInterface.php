<?php

namespace Telegram\Handler;

use Telegram\Entity\Update;
use Telegram\Kernel\RequestInterface;

interface HandlerInterface
{
    public function handle(RequestInterface $request, Update $update): void;

    public function on(string $event, ActionInterface $action): HandlerInterface;
}
