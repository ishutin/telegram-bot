<?php

namespace Telegram\Event;

use Telegram\Exception\TextEventException;
use Telegram\HandlerInterface;

class TextEvent extends Event
{
    /**
     * @var HandlerInterface
     */
    private $handler;

    public function listen()
    {
        if (empty($this->handler)) {
            throw new TextEventException('Invalid handler');
        }

        $request = $this->bot->getRequest();
        $response = $this->bot->getResponse();
        $message = $request->getMessage();
        if ($text = $message->getText() && empty($message->getEntities())) {
            $this->handler->handle($request, $response);
        }
    }

    public function on(HandlerInterface $handler)
    {
        $this->handler = $handler;
    }
}
