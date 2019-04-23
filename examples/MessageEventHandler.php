<?php

namespace Example;

use Exception;
use RuntimeException;
use Telegram\Entity\{Chat, Message, Update};
use Telegram\Event\EventHandlerInterface;
use Telegram\Http\RequestInterface;

class MessageEventHandler implements EventHandlerInterface
{
    /**
     * @param RequestInterface $request
     * @param Update $update
     * @throws Exception
     */
    public function handle(RequestInterface $request, Update $update): void
    {
        $message = $update->getMessage();

        if (!$message instanceof Message) {
            throw new RuntimeException('Invalid message');
        }

        $chat = $message->getChat();

        if (!$chat instanceof Chat) {
            throw new RuntimeException('Invalid chat');
        }

        $request->sendMessage($chat->getId(), 'Hello, world!');
    }
}
