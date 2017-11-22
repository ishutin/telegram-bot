<?php

namespace Telegram\Handler;

use Telegram\Kernel\RequestInterface;
use Telegram\Kernel\ResponseInterface;

interface HandlerInterface
{
    public function handle(RequestInterface $request, ResponseInterface $response): void;
}
