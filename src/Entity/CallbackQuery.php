<?php

namespace Telegram\Entity;

class CallbackQuery
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var User
     */
    private $from;

    /**
     * @var string
     */
    private $chatInstance;

    /**
     * @var Message|null
     */
    private $message;

    /**
     * @var string|null
     */
    private $inlineMessageId;

    /**
     * @var string|null
     */
    private $data;

    /**
     * @var string|null
     */
    private $gameShortName;

    public function __construct(string $id, User $from, string $chatInstance)
    {
        $this->id = $id;
        $this->from = $from;
        $this->chatInstance = $chatInstance;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFrom(): User
    {
        return $this->from;
    }

    public function getChatInstance(): string
    {
        return $this->chatInstance;
    }

    public function getMessage(): ?Message
    {
        return $this->message;
    }

    public function setMessage(?Message $message): void
    {
        $this->message = $message;
    }

    public function getInlineMessageId(): ?string
    {
        return $this->inlineMessageId;
    }

    public function setInlineMessageId(?string $inlineMessageId): void
    {
        $this->inlineMessageId = $inlineMessageId;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(?string $data): void
    {
        $this->data = $data;
    }

    public function getGameShortName(): ?string
    {
        return $this->gameShortName;
    }

    public function setGameShortName(?string $gameShortName): void
    {
        $this->gameShortName = $gameShortName;
    }
}
