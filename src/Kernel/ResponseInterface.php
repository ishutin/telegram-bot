<?php

namespace Telegram\Kernel;

use Telegram\Entity\Chat;
use Telegram\Entity\Message;

interface ResponseInterface
{
    public const TELEGRAM_API_URL = 'https://api.telegram.org/';

    public function sendMessage(Chat $chat, string $text): void;

    public function forwardMessage(
        Message $message,
        Chat $toChat,
        $disableNotification = false
    ): void;
}
