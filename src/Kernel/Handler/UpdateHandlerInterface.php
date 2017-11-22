<?php

namespace Telegram\Kernel\Handler;

use Telegram\Kernel\RequestInterface;

interface UpdateHandlerInterface
{
    public function handle(RequestInterface $request, callable $callback): void;
}
