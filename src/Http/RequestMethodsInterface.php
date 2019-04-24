<?php

namespace Telegram\Http;

use Telegram\Entity\Chat;
use Telegram\Entity\Message;
use Telegram\Entity\Update\Update;
use Telegram\Http\Exception\HttpRequestException;
use Telegram\Http\Exception\MissingEntityFactory;

interface RequestMethodsInterface
{
    /**
     * @param int|null $offset
     * @param int|null $limit
     * @param int|null $timeout
     * @param string|string[]|null $allowedUpdates
     * @return Update[]|null
     * @throws HttpRequestException
     * @throws MissingEntityFactory
     */
    public function getUpdates(
        int $offset = null,
        int $limit = null,
        int $timeout = null,
        $allowedUpdates = null
    ):? array;

    /**
     * @param string $chatId
     * @param string $text
     * @return Message|null
     * @throws HttpRequestException
     * @throws MissingEntityFactory
     */
    public function sendMessage(string $chatId, string $text): ?Message;

    public function forwardMessage(
        Message $message,
        Chat $toChat,
        bool $disableNotification = false
    ): bool;
}
