<?php

namespace Telegram\Http;

use Telegram\Entity\Message;
use Telegram\Entity\Update\Update;
use Telegram\Entity\User;
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
    ): ?array;

    /**
     * @return User
     * @throws HttpRequestException
     * @throws MissingEntityFactory
     */
    public function getMe(): User;

    /**
     * @param string $chatId
     * @param string $text
     * @return Message|null
     * @throws HttpRequestException
     * @throws MissingEntityFactory
     */
    public function sendMessage(string $chatId, string $text): ?Message;

    /**
     * @param int $messageId
     * @param int $fromChatId
     * @param int $toChatId
     * @param bool $disableNotification
     * @return Message
     *
     * @throws HttpRequestException
     * @throws MissingEntityFactory
     */
    public function forwardMessage(
        int $messageId,
        int $fromChatId,
        int $toChatId,
        bool $disableNotification = false
    ): Message;
}
