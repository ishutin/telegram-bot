<?php

namespace Telegram\Handler;

use Telegram\Entity\Update;
use Telegram\Kernel\RequestInterface;

interface EventInterface
{
    public function handle(RequestInterface $request, Update $update): void;
}
