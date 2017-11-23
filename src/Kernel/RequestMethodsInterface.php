<?php

namespace Telegram\Kernel;

use Psr\Http\Message\ResponseInterface;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;

interface RequestMethodsInterface
{
    public function getUpdates(
        int $offset = null,
        int $limit = null,
        int $timeout = null,
        array $allowedUpdates = null
    ): ResponseInterface;

    public function sendMessage(Chat $chat, string $text): bool;

    public function forwardMessage(
        Message $message,
        Chat $toChat,
        bool $disableNotification = false
    ): bool;
}
