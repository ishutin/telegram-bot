<?php

namespace Telegram;

use Exception;
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
        $this->send('sendMessage', [
            'chat_id' => $chat->getId(),
            'text' => $message,
        ]);
    }

    private function send(string $method, array $params)
    {
        $token = $this->config->getToken();

        try {
            $this->config->getHttpClient()->request(
                'GET',
                "/bot$token/$method",
                ['query' => $params]
            );
        } catch (Exception $e) {
            throw new ResponseException($e->getMessage());
        }
    }
}
