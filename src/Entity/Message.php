<?php

namespace Telegram\Entity;

class Message
{
    const TYPE_TEXT = 'text';
    const TYPE_BOT_COMMAND = 'bot_command';
    const TYPE_URL = 'url';

    /**
     * @var int
     */
    private $id;

    /**
     * @var User
     */
    private $from;

    /**
     * @var Chat
     */
    private $chat;

    /**
     * @var string
     */
    private $text;

    /**
     * @var MessageEntity[]
     */
    private $entities = [];

    public function __construct(
        int $id,
        User $from,
        Chat $chat,
        string $text,
        array $entities = []
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->chat = $chat;
        $this->text = $text;
        $this->entities = $entities;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFrom(): User
    {
        return $this->from;
    }

    public function getChat(): Chat
    {
        return $this->chat;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getEntities(): array
    {
        return $this->entities;
    }
}
