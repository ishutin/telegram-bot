<?php

namespace Telegram\Kernel;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;
use Telegram\Exception\RequestException;

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
        bool $allowedUpdates = null
    ): ResponseInterface {
        $query = [];

        if (!is_null($offset)) {
            $query['offset'] = $offset;
        }

        if (!is_null($limit)) {
            $query['$limit'] = $limit;
        }

        if (!is_null($timeout)) {
            $query['timeout'] = $timeout;
        }

        if (!is_null($allowedUpdates)) {
            $query['allowed_updates'] = $allowedUpdates;
        }

        return $this->sendGet('getUpdates', $query);
    }

    public function sendMessage(Chat $chat, string $text): void
    {
        $this->sendGet('sendMessage', [
            'chat_id' => $chat->getId(),
            'text' => $text,
        ]);
    }

    public function forwardMessage(
        Message $message,
        Chat $toChat,
        bool $disableNotification = false
    ): void {
        $this->sendGet('forwardMessage', [
            'chat_id' => $toChat->getId(),
            'from_chat_id' => $message->getChat()->getId(),
            'disable_notification' => $disableNotification,
            'message_id' => $message->getId(),
        ]);
    }

    public function sendGet(string $method, array $params = []): ResponseInterface
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

    public function parseJson(ResponseInterface $response): array
    {
        $body = json_decode($response->getBody(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RequestException('JsonParse: ' . json_last_error_msg());
        }

        if (empty($body['ok']) || (!empty($body['ok'] && $body['ok'] == false))) {
            throw new RequestException('ResponseError: ' . $body['description'] ?? 'Unknown');
        }

        return $body['result'];
    }

    private function getRequestUri(string $method): string
    {
        return "/bot{$this->token}/$method";
    }
}
