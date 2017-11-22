<?php

namespace Telegram\Kernel;

use Psr\Http\Message\ResponseInterface;

interface RequestInterface
{
    public function sendGet(string $method, array $params): ResponseInterface;

    public function parseJson(ResponseInterface $response, bool $assoc = false): array;
}
