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
    private $responseUrl;

    /**
     * @var string
     */
    private $token;

    public function __construct(string $token, $responseUrl = self::TELEGRAM_API_URL)
    {
        $this->token = $token;
        $this->responseUrl = $responseUrl;
    }

    public function setHttpClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getResponseUrl(): string
    {
        return $this->responseUrl;
    }

    public function getHttpClient()
    {
        return $this->client;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
