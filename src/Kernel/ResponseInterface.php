<?php

namespace Telegram\Kernel;

use Telegram\Entity\Chat;

interface ResponseInterface
{
    public const TELEGRAM_API_URL = 'https://api.telegram.org/';

    public function sendMessage(Chat $chat, string $text): void;
}
