<?php

namespace Telegram\Event;

use Telegram\Entity\Update;
use Telegram\Kernel\RequestInterface;

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
        $handler = null;

        if ($handlerAllEvents = $this->storage->getHandler(EventStorageInterface::EVENT_ALL)) {
            $handlerAllEvents->handle($request, $update);
        }

        if ($update->getMessage()) {
            $handler = $this->storage->getHandler(EventStorageInterface::EVENT_MESSAGE);
        } elseif ($update->getEditedMessage()) {
            $handler = $this->storage->getHandler(EventStorageInterface::EVENT_EDITED_MESSAGE);
        } elseif ($update->getChannelPost()) {
            $handler = $this->storage->getHandler(EventStorageInterface::EVENT_CHANNEL_POST);
        } elseif ($update->getEditedChannelPost()) {
            $handler = $this->storage->getHandler(EventStorageInterface::EVENT_EDITED_CHANNEL_POST);
        } elseif ($update->getInlineQuery()) {
            $handler = $this->storage->getHandler(EventStorageInterface::EVENT_INLINE_QUERY);
        } elseif ($update->getChosenInlineResult()) {
            $handler = $this->storage->getHandler(EventStorageInterface::EVENT_CHOSEN_INLINE_RESULT);
        } elseif ($update->getCallbackQuery()) {
            $handler = $this->storage->getHandler(EventStorageInterface::EVENT_CALLBACK_QUERY);
        } elseif ($update->getPreCheckoutQuery()) {
            $handler = $this->storage->getHandler(EventStorageInterface::EVENT_PRE_CHECKOUT_QUERY);
        }

        if ($handler !== null) {
            $handler->handle($request, $update);
        }
    }
}
