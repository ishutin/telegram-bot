<?php

namespace Telegram;

use Telegram\Entity\Message;

interface RequestInterface
{
    public function getMessage(): Message;
}
