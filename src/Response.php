<?php

namespace Telegram;

use GuzzleHttp\Exception\ClientException;
use Telegram\Entity\Chat;
use Telegram\Exception\ResponseException;

class Response
{
    /**
     * @var Config
     */
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function sendMessage(Chat $chat, string $message)
    {
        $this->sendGet('sendMessage', [
            'chat_id' => $chat->getId(),
            'text' => $message,
        ]);
    }

    private function sendGet(string $method, array $params)
    {
        try {
            $this->config->getHttpClient()->request(
                'GET',
                $this->getUri($method),
                ['query' => $params]
            );
        } catch (ClientException $e) {
            throw new ResponseException($e->getMessage());
        }
    }

    private function getUri(string $method): string
    {
        return "/bot{$this->config->getToken()}/$method";
    }
}
