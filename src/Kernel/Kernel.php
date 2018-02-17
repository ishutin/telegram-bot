<?php

namespace Telegram\Kernel;

class Kernel
{
    /**
     * @var HandlerInterface[]
     */
    private $handlers = [];

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
            $handler->handle();
        }
    }
}
