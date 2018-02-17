<?php

namespace Telegram\Kernel;

use Telegram\Entity\Update;
use Telegram\Handler\EventHandlerInterface;
use Telegram\Kernel\Handler\UpdateHandlerInterface;

class Kernel
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var UpdateHandlerInterface
     */
    private $updateHandler;

    /**
     * @var EventHandlerInterface[]
     */
    private $handlers = [];

    public function __construct(
        RequestInterface $request,
        UpdateHandlerInterface $updateHandler
    ) {
        $this->request = $request;
        $this->updateHandler = $updateHandler;
    }

    public function attachHandler(EventHandlerInterface $handler): void
    {
        $this->handlers[get_class($handler)] = $handler;
    }

    public function detachHandler(EventHandlerInterface $handler): void
    {
        $key = get_class($handler);
        if (isset($this->handlers[$key])) {
            unset($this->handlers[$key]);
        }
    }

    public function run(): void
    {
        $this->updateHandler->handle($this->request, function (Update $update) {
            foreach ($this->handlers as $handler) {
                $handler->handle($this->request, $update);
            }
        });
    }
}
