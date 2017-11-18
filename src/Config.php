<?php

namespace Telegram;

use GuzzleHttp\ClientInterface;

class Config
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $token;

    public function __construct(ClientInterface $client, string $token)
    {
        $this->client = $client;
        $this->token = $token;
    }

    public function getHttpClient(): ClientInterface
    {
        return $this->client;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
