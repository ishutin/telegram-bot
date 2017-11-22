<?php

namespace Telegram\Handler;

use Telegram\Exception\HandlerException;
use Telegram\Exception\TextHandlerException;
use Telegram\EventInterface;
use Telegram\RequestInterface;
use Telegram\ResponseInterface;

class TextHandler implements HandlerInterface
{
    /**
     * @var EventInterface
     */
    private $event;

    public function listen(RequestInterface $request, ResponseInterface $response): void
    {
        if (empty($this->event)) {
            throw new HandlerException('Invalid handler');
        }

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
