<?php

namespace Telegram\Handler;

use Telegram\Exception\TextHandlerException;
use Telegram\EventInterface;

class TextHandler extends Handler
{
    /**
     * @var EventInterface
     */
    private $event;

    public function listen(): void
    {
        if (empty($this->event)) {
            throw new TextHandlerException('Invalid handler');
        }

        $request = $this->bot->getRequest();
        $response = $this->bot->getResponse();
        $message = $request->getMessage();

        $isCommand = false;

        foreach ($message->entities as $entity) {
            if ($entity->type == $entity::TYPE_BOT_COMMAND) {
                $isCommand = true;
                break;
            }
        }

        if ($text = $message->text && !$isCommand) {
            $this->event->handle($request, $response);
        }
    }

    public function on(EventInterface $event): void
    {
        $this->event = $event;
    }
}
