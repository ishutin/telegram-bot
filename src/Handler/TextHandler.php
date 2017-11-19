<?php

namespace Telegram\Handler;

use Telegram\Exception\TextHandlerException;
use Telegram\EventInterface;

class TextHandler extends Handler
{
    /**
     * @var EventInterface
     */
    private $handler;

    public function listen()
    {
        if (empty($this->handler)) {
            throw new TextHandlerException('Invalid handler');
        }

        $request = $this->bot->getRequest();
        $response = $this->bot->getResponse();
        $message = $request->getMessage();
        if ($text = $message->getText() && empty($message->getEntities())) {
            $this->handler->handle($request, $response);
        }
    }

    public function on(EventInterface $handler)
    {
        $this->handler = $handler;
    }
}
