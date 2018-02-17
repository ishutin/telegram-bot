<?php

namespace Telegram\Kernel;

interface HandlerInterface
{
    public function handle(RequestInterface $request): void;
}
