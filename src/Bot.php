<?php

namespace Telegram;

use GuzzleHttp\Client;
use Telegram\Exception\RequestException;

class Bot
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    public function __construct(Config $config)
    {
        if (empty($config->getHttpClient())) {
            // Base HTTP Client - Guzzle
            $config->setHttpClient(new Client([
                'base_uri' => $config::TELEGRAM_API_URL,
            ]));
        }

        $this->config = $config;
    }

    public function getRequest(array $request = null): Request
    {
        if (!$this->request) {
            $request = $request ?? json_decode(file_get_contents('php://input'), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RequestException(json_last_error_msg());
            }

            $this->request = new Request($request);
        }

        return $this->request;
    }

    public function getResponse()
    {
        if (!$this->response) {
            $this->response = new Response($this->config);
        }

        return $this->response;
    }
}
