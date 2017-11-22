<?php

namespace Telegram;

use Telegram\Handler\HandlerInterface;
use Telegram\Exception\HandlerException;

class Kernel
{
    /**
     * @var HandlerInterface[]
     */
    private $handlers = [];

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function run(): bool
    {
        $this->listenHandlers();

        return true;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function pushHandler(HandlerInterface $event): void
    {
        $this->handlers[get_class($event)] = $event;
    }

    private function listenHandlers(): void
    {
        try {
            foreach ($this->handlers as $event) {
                $event->listen($this->request, $this->response);
            }
        } catch (HandlerException $e) {
            throw $e;
        }
    }
}
