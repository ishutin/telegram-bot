<?php

namespace Telegram\Event;

use Telegram\Entity\Update;
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

        if ($update->getMessage()) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_MESSAGE);
        } elseif ($update->getEditedMessage()) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_EDITED_MESSAGE);
        } elseif ($update->getChannelPost()) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_CHANNEL_POST);
        } elseif ($update->getEditedChannelPost()) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_EDITED_CHANNEL_POST);
        } elseif ($update->getInlineQuery()) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_INLINE_QUERY);
        } elseif ($update->getChosenInlineResult()) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_CHOSEN_INLINE_RESULT);
        } elseif ($update->getCallbackQuery()) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_CALLBACK_QUERY);
        } elseif ($update->getPreCheckoutQuery()) {
            $handlers = $this->storage->getHandlers(EventStorageInterface::EVENT_PRE_CHECKOUT_QUERY);
        }

        if ($handlersAllEvents = $this->storage->getHandlers(EventStorageInterface::EVENT_ALL)) {
            $handlers = array_merge($handlers, $handlersAllEvents);
        }

        return $handlers;
    }
}
