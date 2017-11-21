<?php

namespace Telegram;

use GuzzleHttp\Client;
use Telegram\Handler\Handler;
use Telegram\Handler\HandlerInterface;
use Telegram\Exception\HandlerException;
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

    /**
     * @var Handler[]
     */
    private $handlers = [];

    public function __construct(Config $config)
    {
        if (empty($config->getHttpClient())) {
            $config->setHttpClient(new Client([
                'base_uri' => $config::TELEGRAM_API_URL,
            ]));
        }

        $this->config = $config;
    }

    public function run(): bool
    {
        $this->listenHandlers();

        return true;
    }

    public function initRequest(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function getRequest(): Request
    {
        if (!$this->request) {
            throw new RequestException('Request was not initialized');
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

    public function pushHandler(HandlerInterface $event)
    {
        $this->handlers[get_class($event)] = $event;
    }

    private function listenHandlers()
    {
        try {
            foreach ($this->handlers as $event) {
                $event->listen();
            }
        } catch (HandlerException $e) {
            throw $e;
        }
    }
}
