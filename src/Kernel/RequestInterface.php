<?php

namespace Telegram\Kernel;

use Telegram\Entity\Message;

interface RequestInterface
{
    public function getMessage(): Message;
}
