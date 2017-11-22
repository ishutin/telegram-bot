<?php

namespace Telegram\Kernel;

use Telegram\Handler\HandlerInterface;
use Telegram\Exception\HandlerException;
use Telegram\Kernel\RequestInterface;
use Telegram\Kernel\ResponseInterface;

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
        $this->runHandlers();

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

    private function runHandlers(): void
    {
        try {
            foreach ($this->handlers as $event) {
                $event->handle($this->request, $this->response);
            }
        } catch (HandlerException $e) {
            throw $e;
        }
    }
}
