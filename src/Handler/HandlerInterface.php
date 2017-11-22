<?php

namespace Telegram\Handler;

use Telegram\RequestInterface;
use Telegram\ResponseInterface;

interface HandlerInterface
{
    public function listen(RequestInterface $request, ResponseInterface $response): void;
}
