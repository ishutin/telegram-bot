<?php

namespace Telegram\Kernel;

use Telegram\Entity\Update;
use Telegram\Kernel\HandlerInterface;
use Telegram\Kernel\Handler\UpdateHandlerInterface;

class Kernel
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var HandlerInterface[]
     */
    private $handlers = [];

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function attachHandler(HandlerInterface $handler): void
    {
        $this->handlers[get_class($handler)] = $handler;
    }

    public function detachHandler(HandlerInterface $handler): void
    {
        $key = get_class($handler);
        if (isset($this->handlers[$key])) {
            unset($this->handlers[$key]);
        }
    }

    public function run(): void
    {
        foreach ($this->handlers as $handler) {
            $handler->handle($this->request);
        }
    }
}
