<?php

namespace Telegram\Kernel;

use Psr\Http\Message\ResponseInterface;

interface RequestInterface extends RequestMethodsInterface
{
    public function parseJson(ResponseInterface $response): array;
}
