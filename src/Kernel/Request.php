<?php

namespace Telegram\Kernel;

use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;
use Telegram\Kernel\Exception\RequestException;

class Request implements RequestInterface
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $apiUrl = 'https://api.telegram.org/';

    public function __construct(string $token, ClientInterface $client = null)
    {
        $this->token = $token;
        $this->client = $client;

        if ($this->client === null) {
            $this->client = new Client([
                'base_uri' => $this->apiUrl,
            ]);
        }
    }

    public function setApiUrl(string $url): void
    {
        $this->apiUrl = $url;
    }

    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }

    /**
     * @param int|null $offset
     * @param int|null $limit
     * @param int|null $timeout
     * @param string|string[]|null $allowedUpdates
     * @return ResponseInterface
     * @throws RequestException
     */
    public function getUpdates(
        int $offset = null,
        int $limit = null,
        int $timeout = null,
        $allowedUpdates = null
    ): ResponseInterface {
        $query = array_filter([
            'offset' => $offset,
            'limit' => $limit,
            'timeout' => $timeout,
            'allowed_updates' => $allowedUpdates,
        ], function ($var) {
            return $var !== null;
        });

        return $this->sendGet('getUpdates', $query);
    }

    /**
     * @param string $chatId
     * @param string $text
     * @return bool
     * @throws RequestException
     */
    public function sendMessage(string $chatId, string $text): bool
    {
        $response = $this->sendGet('sendMessage', [
            'chat_id' => $chatId,
            'text' => $text,
        ]);

        return $response->getStatusCode() === StatusCodeInterface::STATUS_OK;
    }

    /**
     * @param Message $message
     * @param Chat $toChat
     * @param bool $disableNotification
     * @return bool
     * @throws RequestException
     */
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

        return $response->getStatusCode() === StatusCodeInterface::STATUS_OK;
    }

    /**
     * @param string $method
     * @param array $params
     * @return ResponseInterface
     * @throws RequestException
     */
    private function sendGet(string $method, array $params = []): ResponseInterface
    {
        try {
            return $this->client->request(
                'get',
                $this->getRequestUri($method),
                ['query' => $params]
            );
        } catch (ClientException | GuzzleException $e) {
            throw new RequestException($e->getMessage());
        }
    }

    private function getRequestUri(string $method): string
    {
        return "/bot{$this->token}/$method";
    }
}
