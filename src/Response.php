<?php

namespace Telegram;

use Telegram\Entity\Chat;

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
        $this->send('sendMessage', [
            'chat_id' => $chat->getId(),
            'text' => $message,
        ]);
    }

    private function send(string $method, array $params)
    {
        $token = $this->config->getToken();

        $this->config->getHttpClient()->request(
            'GET',
            "/bot$token/$method",
            ['query' => $params]
        );
    }
}
