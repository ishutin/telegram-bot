<?php

namespace Telegram\Kernel;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;
use Telegram\Exception\RequestException;
use Telegram\Helper\HttpCode;

class Request implements RequestInterface
{
    private const API_URL = 'https://api.telegram.org/';

    /**
     * @var string
     */
    private $token;

    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(string $token, ClientInterface $client = null)
    {
        $this->token = $token;
        $this->client = $client;

        if (is_null($this->client)) {
            $this->client = new Client([
                'base_uri' => self::API_URL,
            ]);
        }
    }

    public function getUpdates(
        int $offset = null,
        int $limit = null,
        int $timeout = null,
        array $allowedUpdates = null
    ): ResponseInterface {
        $query = [
            'offset' => $offset,
            'limit' => $limit,
            'timeout' => $timeout,
            'allowed_updates' => $allowedUpdates,
        ];

        $query = array_filter($query, function ($var) {
            return !is_null($var);
        });

        return $this->sendGet('getUpdates', $query);
    }

    public function sendMessage(Chat $chat, string $text): bool
    {
        $response = $this->sendGet('sendMessage', [
            'chat_id' => $chat->getId(),
            'text' => $text,
        ]);

        return $response->getStatusCode() === HttpCode::OK;
    }

    public function forwardMessage(
        Message $message,
        Chat $toChat,
        bool $disableNotification = false
    ): bool {
        $response = $this->sendGet('forwardMessage', [
            'chat_id' => $toChat->getId(),
            'from_chat_id' => $message->getChat()->getId(),
            'disable_notification' => $disableNotification,
            'message_id' => $message->getId(),
        ]);

        return $response->getStatusCode() === HttpCode::OK;
    }

    private function sendGet(string $method, array $params = []): ResponseInterface
    {
        try {
            return $this->client->request(
                'get',
                $this->getRequestUri($method),
                ['query' => $params]
            );
        } catch (ClientException $e) {
            throw new RequestException($e->getMessage());
        }
    }

    private function getRequestUri(string $method): string
    {
        return "/bot{$this->token}/$method";
    }
}
