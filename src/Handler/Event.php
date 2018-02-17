<?php

namespace Telegram\Handler;

use Telegram\Entity\Update;
use Telegram\Kernel\HandlerInterface;
use Telegram\Kernel\RequestInterface;

class Event implements HandlerInterface
{
    public const EVENT_ALL = 'all';
    public const EVENT_MESSAGE = 'message';
    public const EVENT_CHANNEL_POST = 'channel_post';
    public const EVENT_EDITED_MESSAGE = 'edited_message';
    public const EVENT_EDITED_CHANNEL_POST = 'edited_channel_post';
    public const EVENT_INLINE_QUERY = 'inline_query';
    public const EVENT_CHOSEN_INLINE_RESULT = 'chosen_inline_result';
    public const EVENT_CALLBACK_QUERY = 'callback_query';
    public const EVENT_PRE_CHECKOUT_QUERY = 'pre_checkout_query';

    /**
     * @var HandlerInterface[]
     */
    private $events;

    public function handle(RequestInterface $request, Update $update): void
    {
        if ($handler = $this->getHandler(self::EVENT_ALL)) {
            $handler->handle($request, $update);
        } else {
            if ($handler = $this->getHandler(self::EVENT_MESSAGE)) {
                if ($update->getMessage()) {
                    $handler->handle($request, $update);
                }
            } elseif ($handler = $this->getHandler(self::EVENT_CHANNEL_POST)) {
                if ($update->getChannelPost()) {
                    $handler->handle($request, $update);
                }
            } elseif ($handler = $this->getHandler(self::EVENT_EDITED_MESSAGE)) {
                if ($update->getEditedMessage()) {
                    $handler->handle($request, $update);
                }
            } elseif ($handler = $this->getHandler(self::EVENT_EDITED_CHANNEL_POST)) {
                if ($update->getEditedChannelPost()) {
                    $handler->handle($request, $update);
                }
            } elseif ($handler = $this->getHandler(self::EVENT_INLINE_QUERY)) {
                if ($update->getInlineQuery()) {
                    $handler->handle($request, $update);
                }
            } elseif ($handler = $this->getHandler(self::EVENT_CHOSEN_INLINE_RESULT)) {
                if ($update->getChosenInlineResult()) {
                    $handler->handle($request, $update);
                }
            } elseif ($handler = $this->getHandler(self::EVENT_CALLBACK_QUERY)) {
                if ($update->getCallbackQuery()) {
                    $handler->handle($request, $update);
                }
            } elseif ($handler = $this->getHandler(self::EVENT_PRE_CHECKOUT_QUERY)) {
                if ($update->getPreCheckoutQuery()) {
                    $handler->handle($request, $update);
                }
            }
        }
    }

    public function on(string $event, EventHandlerInterface $handler): HandlerInterface
    {
        $this->events[$event] = $handler;

        return $this;
    }

    private function getHandler(string $event): ? HandlerInterface
    {
        return $this->events[$event] ?? null;
    }
}
