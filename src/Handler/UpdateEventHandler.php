<?php

namespace Telegram\Handler;

use Telegram\Entity\Update;
use Telegram\Kernel\RequestInterface;

class UpdateEventHandler extends AbstractHandler
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
            $action->run($request, $update);
        } else {
            if ($action = $this->getAction(self::EVENT_MESSAGE)) {
                if ($update->getMessage()) {
                    $action->run($request, $update);
                }
            } elseif ($action = $this->getAction(self::EVENT_CHANNEL_POST)) {
                if ($update->getChannelPost()) {
                    $action->run($request, $update);
                }
            } elseif ($action = $this->getAction(self::EVENT_EDITED_MESSAGE)) {
                if ($update->getEditedMessage()) {
                    $action->run($request, $update);
                }
            } elseif ($action = $this->getAction(self::EVENT_EDITED_CHANNEL_POST)) {
                if ($update->getEditedChannelPost()) {
                    $action->run($request, $update);
                }
            } elseif ($action = $this->getAction(self::EVENT_INLINE_QUERY)) {
                if ($update->getInlineQuery()) {
                    $action->run($request, $update);
                }
            } elseif ($action = $this->getAction(self::EVENT_CHOSEN_INLINE_RESULT)) {
                if ($update->getChosenInlineResult()) {
                    $action->run($request, $update);
                }
            } elseif ($action = $this->getAction(self::EVENT_CALLBACK_QUERY)) {
                if ($update->getCallbackQuery()) {
                    $action->run($request, $update);
                }
            } elseif ($action = $this->getAction(self::EVENT_PRE_CHECKOUT_QUERY)) {
                if ($update->getPreCheckoutQuery()) {
                    $action->run($request, $update);
                }
            }
        }
    }

    private function getAction(string $event):? ActionInterface
    {
        return $this->events[$event] ?? null;
    }
}
