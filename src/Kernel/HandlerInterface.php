<?php

namespace Telegram\Kernel;

use Telegram\Entity\Update;

interface HandlerInterface
{
    public function handle(RequestInterface $request, Update $update): void;
}
