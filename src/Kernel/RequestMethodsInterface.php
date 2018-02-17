<?php

namespace Telegram\Kernel;

use Psr\Http\Message\ResponseInterface;
use Telegram\Entity\Chat;
use Telegram\Entity\Message;

interface RequestMethodsInterface
{
    /**
     * @param int|null $offset
     * @param int|null $limit
     * @param int|null $timeout
     * @param string|string[]|null $allowedUpdates
     * @return ResponseInterface
     */
    public function getUpdates(
        int $offset = null,
        int $limit = null,
        int $timeout = null,
        $allowedUpdates = null
    ): ResponseInterface;

    public function sendMessage(string $chatId, string $text): bool;

    public function forwardMessage(
        Message $message,
        Chat $toChat,
        bool $disableNotification = false
    ): bool;
}
