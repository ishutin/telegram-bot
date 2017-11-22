<?php

namespace Telegram\Kernel;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
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

    public function getClient(): ClientInterface
    {
        return $this->client;
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
        $body = json_decode($response->getBody(), false);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RequestException('JsonParse: ' . json_last_error_msg());
        }

        if (empty($body['ok']) || (!empty($body['ok'] && $body['ok'] == false))) {
            throw new RequestException('ResponseError: ' . $body['description'] ?? 'unknown');
        }

        return $body['result'];
    }

    private function getRequestUri(string $method): string
    {
        return "/bot{$this->token}/$method";
    }
}
