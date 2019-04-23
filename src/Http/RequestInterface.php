<?php

namespace Telegram\Http;

use GuzzleHttp\ClientInterface;

interface RequestInterface extends RequestMethodsInterface
{
    public function getClient(): ClientInterface;
}
