<?php

namespace Telegram\Handler;

use Telegram\Entity\Update;
use Telegram\Kernel\RequestInterface;

class EventHandler extends AbstractEventHandler
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

    public function handle(RequestInterface $request, Update $update): void
    {
        if ($action = $this->getAction(self::EVENT_ALL)) {
            $action->handle($request, $update);
        } else {
            if ($action = $this->getAction(self::EVENT_MESSAGE)) {
                if ($update->getMessage()) {
                    $action->handle($request, $update);
                }
            } elseif ($action = $this->getAction(self::EVENT_CHANNEL_POST)) {
                if ($update->getChannelPost()) {
                    $action->handle($request, $update);
                }
            } elseif ($action = $this->getAction(self::EVENT_EDITED_MESSAGE)) {
                if ($update->getEditedMessage()) {
                    $action->handle($request, $update);
                }
            } elseif ($action = $this->getAction(self::EVENT_EDITED_CHANNEL_POST)) {
                if ($update->getEditedChannelPost()) {
                    $action->handle($request, $update);
                }
            } elseif ($action = $this->getAction(self::EVENT_INLINE_QUERY)) {
                if ($update->getInlineQuery()) {
                    $action->handle($request, $update);
                }
            } elseif ($action = $this->getAction(self::EVENT_CHOSEN_INLINE_RESULT)) {
                if ($update->getChosenInlineResult()) {
                    $action->handle($request, $update);
                }
            } elseif ($action = $this->getAction(self::EVENT_CALLBACK_QUERY)) {
                if ($update->getCallbackQuery()) {
                    $action->handle($request, $update);
                }
            } elseif ($action = $this->getAction(self::EVENT_PRE_CHECKOUT_QUERY)) {
                if ($update->getPreCheckoutQuery()) {
                    $action->handle($request, $update);
                }
            }
        }
    }

    private function getAction(string $event):? EventInterface
    {
        return $this->events[$event] ?? null;
    }
}
