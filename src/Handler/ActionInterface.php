<?php

namespace Telegram\Handler;

use Telegram\RequestInterface;
use Telegram\ResponseInterface;

interface ActionInterface
{
    public function handle(RequestInterface $request, ResponseInterface $response): void;
}
