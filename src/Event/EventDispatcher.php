<?php

namespace Telegram\Event;

use Telegram\Entity\Update\Update;
use Telegram\Entity\Update\UpdateCallbackQuery;
use Telegram\Entity\Update\UpdateChannelPost;
use Telegram\Entity\Update\UpdateChosenInlineResult;
use Telegram\Entity\Update\UpdateEditedChannelPost;
use Telegram\Entity\Update\UpdateEditedMessage;
use Telegram\Entity\Update\UpdateInlineQuery;
use Telegram\Entity\Update\UpdateMessage;
use Telegram\Entity\Update\UpdatePreCheckoutQuery;
use Telegram\Http\RequestInterface;

class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var EventStorageInterface
     */
    private $storage;

    public function __construct(EventStorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @inheritDoc
     */
    public function dispatch(RequestInterface $request, Update $update): void
    {
        foreach ($this->getHandlers($update) as $handler) {
            $handler->handle($request, $update);
        }
    }

    /**
     * @param Update $update
     * @return EventHandlerInterface[]
     */
    private function getHandlers(Update $update): array
    {
        $handlers = [];

        if ($update instanceof UpdateMessage) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_MESSAGE);
        } elseif ($update instanceof UpdateEditedMessage) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_EDITED_MESSAGE);
        } elseif ($update instanceof UpdateChannelPost) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_CHANNEL_POST);
        } elseif ($update instanceof UpdateEditedChannelPost) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_EDITED_CHANNEL_POST);
        } elseif ($update instanceof UpdateInlineQuery) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_INLINE_QUERY);
        } elseif ($update instanceof UpdateChosenInlineResult) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_CHOSEN_INLINE_RESULT);
        } elseif ($update instanceof UpdateCallbackQuery) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_CALLBACK_QUERY);
        } elseif ($update instanceof UpdatePreCheckoutQuery) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_PRE_CHECKOUT_QUERY);
        }

        if ($handlersAllEvents = $this->storage->getHandlers(EventStorageInterface::EVENT_ALL)) {
            $handlers = array_merge($handlers, $handlersAllEvents);
        }

        return $handlers;
    }
}
