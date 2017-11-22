<?php

namespace Telegram\Handler;

use Telegram\Entity\Update;
use Telegram\Kernel\RequestInterface;

interface ActionInterface
{
    public function run(RequestInterface $request, Update $update): void;
}
