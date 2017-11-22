<?php

namespace Telegram\Handler;

use Telegram\Kernel\RequestInterface;
use Telegram\Kernel\ResponseInterface;

interface ActionInterface
{
    public function execute(RequestInterface $request, ResponseInterface $response): void;
}
