<?php

namespace Telegram\Entity\Update;

use Telegram\Entity\CallbackQuery;
use Telegram\Entity\Inline\ChosenInlineResult;
use Telegram\Entity\Inline\InlineQuery;
use Telegram\Entity\Message;
use Telegram\Entity\Payment\PreCheckoutQuery;
use Telegram\Entity\Payment\ShippingQuery;
use Telegram\Entity\Poll;

class Update
{
    /**
     * @var int
     */
    private $updateId;

    /**
     * @var Message|null
     */
    private $message;

    /**
     * @var Message|null
     */
    private $channelPost;

    /**
     * @var Message|null
     */
    private $editedMessage;

    /**
     * @var Message|null
     */
    private $editedChannelPost;

    /**
     * @var InlineQuery|null
     */
    private $inlineQuery;

    /**
     * @var ChosenInlineResult|null
     */
    private $chosenInlineResult;

    /**
     * @var CallbackQuery|null
     */
    private $callbackQuery;

    /**
     * @var ShippingQuery|null
     */
    private $shippingQuery;

    /**
     * @var PreCheckoutQuery|null
     */
    private $preCheckoutQuery;

    /**
     * @var Poll|null
     */
    private $poll;

    public function __construct(int $updateId)
    {
        $this->updateId = $updateId;
    }

    public function getUpdateId(): int
    {
        return $this->updateId;
    }

    public function getMessage(): ?Message
    {
        return $this->message;
    }

    public function getChannelPost(): ?Message
    {
        return $this->channelPost;
    }

    public function getEditedMessage(): ?Message
    {
        return $this->editedMessage;
    }

    public function getEditedChannelPost(): ?Message
    {
        return $this->editedChannelPost;
    }

    public function getInlineQuery(): ?InlineQuery
    {
        return $this->inlineQuery;
    }

    public function getChosenInlineResult(): ?ChosenInlineResult
    {
        return $this->chosenInlineResult;
    }

    public function getCallbackQuery(): ?CallbackQuery
    {
        return $this->callbackQuery;
    }

    public function getPreCheckoutQuery(): ?PreCheckoutQuery
    {
        return $this->preCheckoutQuery;
    }

    public function getShippingQuery(): ?ShippingQuery
    {
        return $this->shippingQuery;
    }

    public function getPoll(): ?Poll
    {
        return $this->poll;
    }

    public function setMessage(Message $message = null): void
    {
        $this->message = $message;
    }

    public function setChannelPost(Message $channelPost = null): void
    {
        $this->channelPost = $channelPost;
    }

    public function setEditedChannelPost(Message $editedChannelPost = null): void
    {
        $this->editedChannelPost = $editedChannelPost;
    }

    public function setInlineQuery(InlineQuery $inlineQuery = null): void
    {
        $this->inlineQuery = $inlineQuery;
    }

    public function setChosenInlineResult(ChosenInlineResult $chosenInlineResult = null): void
    {
        $this->chosenInlineResult = $chosenInlineResult;
    }

    public function setCallbackQuery(CallbackQuery $callbackQuery = null): void
    {
        $this->callbackQuery = $callbackQuery;
    }

    public function setPreCheckoutQuery(PreCheckoutQuery $preCheckoutQuery = null): void
    {
        $this->preCheckoutQuery = $preCheckoutQuery;
    }

    public function setEditedMessage(Message $editedMessage = null): void
    {
        $this->editedMessage = $editedMessage;
    }

    public function setShippingQuery(ShippingQuery $shippingQuery): void
    {
        $this->shippingQuery = $shippingQuery;
    }

    public function setPoll(?Poll $poll): void
    {
        $this->poll = $poll;
    }
}
