<?php

namespace Telegram\Http;

use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Telegram\Entity\Factory\EntityFactoryInterface;
use Telegram\Entity\Message;
use Telegram\Entity\User;
use Telegram\Http\Exception\HttpRequestException;
use Telegram\Http\Exception\MissingEntityFactory;

class Request implements RequestInterface
{
    public const API_URL = 'https://api.telegram.org/';
    /**
     * @var string
     */
    private $token;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var EntityFactoryInterface
     */
    private $entityFactory;

    public function __construct(string $token, ClientInterface $client = null)
    {
        $this->token = $token;
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function getUpdates(
        int $offset = null,
        int $limit = null,
        int $timeout = null,
        $allowedUpdates = null
    ): ?array {
        $query = array_filter([
            'offset' => $offset,
            'limit' => $limit,
            'timeout' => $timeout,
            'allowed_updates' => $allowedUpdates,
        ], static function ($var) {
            return $var !== null;
        });

        $response = $this->sendGet('getUpdates', $query);

        $data = $this->getResponseData($response);

        if (empty($data)) {
            return null;
        }

        $updates = [];

        foreach ($data as $updateData) {
            $updates[] = $this->getEntityFactory()->createUpdate($updateData);
        }

        return $updates;
    }

    /**
     * @param string $method
     * @param array $params
     * @return ResponseInterface
     * @throws HttpRequestException
     */
    private function sendGet(string $method, array $params = []): ResponseInterface
    {
        try {
            return $this->getClient()->request(
                'get',
                $this->getRequestUri($method),
                ['query' => $params]
            );
        } catch (ClientException | GuzzleException $e) {
            throw new HttpRequestException($e->getMessage());
        }
    }

    public function getClient(): ClientInterface
    {
        if ($this->client === null) {
            $this->client = new Client([
                'base_uri' => self::API_URL,
            ]);
        }

        return $this->client;
    }

    private function getRequestUri(string $method): string
    {
        return "/bot{$this->token}/$method";
    }

    public function getResponseData(ResponseInterface $response): ?array
    {
        $data = \GuzzleHttp\json_decode($response->getBody(), true);

        if (empty($data['ok'])) {
            return null;
        }

        return $data['result'] ?? [];
    }

    public function getEntityFactory(): EntityFactoryInterface
    {
        if ($this->entityFactory === null) {
            throw new MissingEntityFactory('Missing EntityFactory');
        }

        return $this->entityFactory;
    }

    public function setEntityFactory(EntityFactoryInterface $entityFactory): RequestInterface
    {
        $this->entityFactory = $entityFactory;

        return $this;
    }

    public function getMe(): User
    {
        $response = $this->sendGet('getMe');

        $data = $this->getResponseData($response);

        if (empty($data)) {
            return null;
        }

        return $this->getEntityFactory()->createUser($data);
    }

    /**
     * @inheritDoc
     */
    public function sendMessage(string $chatId, string $text): ?Message
    {
        $response = $this->sendGet('sendMessage', [
            'chat_id' => $chatId,
            'text' => $text,
        ]);

        if ($response->getStatusCode() !== StatusCodeInterface::STATUS_OK) {
            return null;
        }

        $data = $this->getResponseData($response);

        if (empty($data)) {
            return null;
        }

        return $this->getEntityFactory()->createMessage($data);
    }

    /**
     * @inheritDoc
     */
    public function forwardMessage(
        int $messageId,
        int $fromChatId,
        int $toChatId,
        bool $disableNotification = false
    ): Message {
        $response = $this->sendGet('forwardMessage', [
            'chat_id' => $toChatId,
            'from_chat_id' => $fromChatId,
            'disable_notification' => $disableNotification,
            'message_id' => $messageId,
        ]);

        $data = $this->getResponseData($response);

        if (empty($data)) {
            return null;
        }

        return $this->getEntityFactory()->createMessage($data);
    }

    /**
     * @param string $method
     * @param array $params
     * @return ResponseInterface
     * @throws HttpRequestException
     */
    private function sendPost(string $method, array $params = []): ResponseInterface
    {
        try {
            return $this->getClient()->request(
                'post',
                $this->getRequestUri($method),
                ['body' => $params]
            );
        } catch (ClientException | GuzzleException $e) {
            throw new HttpRequestException($e->getMessage());
        }
    }
}
