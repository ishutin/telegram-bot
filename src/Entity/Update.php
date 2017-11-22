<?php

namespace Telegram\Entity;

use Telegram\Entity\Inline\ChosenInlineResult;
use Telegram\Entity\Inline\InlineQuery;
use Telegram\Entity\Payment\PreCheckoutQuery;

class Update
{
    /**
     * @var int
     */
    private $updateId;

    /**
     * @var Message
     */
    private $message;

    /**
     * @var Message
     */
    private $channelPost;

    /**
     * @var Message
     */
    private $editedMessage;

    /**
     * @var Message
     */
    private $editedChannelPost;

    /**
     * @var InlineQuery
     */
    private $inlineQuery;

    /**
     * @var ChosenInlineResult
     */
    private $chosenInlineResult;

    /**
     * @var CallbackQuery
     */
    private $callbackQuery;

    /**
     * @var PreCheckoutQuery
     */
    private $preCheckoutQuery;

    public function __construct(int $updateId)
    {
        $this->updateId = $updateId;
    }

    public function getUpdateId(): int
    {
        return $this->updateId;
    }

    public function getMessage():? Message
    {
        return $this->message;
    }

    public function getChannelPost():? Message
    {
        return $this->channelPost;
    }

    public function getEditedMessage():? Message
    {
        return $this->editedMessage;
    }

    public function getEditedChannelPost():? Message
    {
        return $this->editedChannelPost;
    }

    public function getInlineQuery():? InlineQuery
    {
        return $this->inlineQuery;
    }

    public function getChosenInlineResult():? ChosenInlineResult
    {
        return $this->chosenInlineResult;
    }

    public function getCallbackQuery():? CallbackQuery
    {
        return $this->callbackQuery;
    }

    public function getPreCheckoutQuery():? PreCheckoutQuery
    {
        return $this->preCheckoutQuery;
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

}
