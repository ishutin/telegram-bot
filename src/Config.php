<?php

namespace Telegram;

use GuzzleHttp\ClientInterface;

class Config
{
    const TELEGRAM_API_URL = 'https://api.telegram.org/';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function setHttpClient(ClientInterface $client): void
    {
        $this->client = $client;
    }

    public function getHttpClient():? ClientInterface
    {
        return $this->client;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
