<?php

namespace Telegram\Handler\Update;

use Telegram\Kernel\RequestInterface;

interface HandlerInterface
{
    public function handle(RequestInterface $request): void;
}
