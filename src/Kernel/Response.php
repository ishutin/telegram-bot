<?php

namespace Telegram\Kernel;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Telegram\Entity\Chat;
use Telegram\Exception\ResponseException;

class Response implements ResponseInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $token;

    public function __construct(string $token, ClientInterface $client = null)
    {
        $this->token = $token;

        if (is_null($client)) {
            $client = new Client([
                'base_uri' => self::TELEGRAM_API_URL,
            ]);
        }

        $this->client = $client;
    }

    public function sendMessage(Chat $chat, string $text): void
    {
        $this->sendGet('sendMessage', [
            'chat_id' => $chat->getId(),
            'text' => $text,
        ]);
    }

    private function sendGet(string $method, array $params): void
    {
        try {
            $this->client->request(
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
        return "/bot{$this->token}/$method";
    }
}
