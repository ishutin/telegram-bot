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

    public function listen()
    {
        if (empty($this->event)) {
            throw new TextHandlerException('Invalid handler');
        }

        $request = $this->bot->getRequest();
        $response = $this->bot->getResponse();
        $message = $request->getMessage();
        if ($text = $message->getText() && empty($message->getEntities())) {
            $this->event->handle($request, $response);
        }
    }

    public function on(EventInterface $event)
    {
        $this->handler = $event;
    }
}
