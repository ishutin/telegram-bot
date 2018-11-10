<?php

use Telegram\Entity\{Chat, Message, Update};
use Telegram\Handler\Update\EventHandlerInterface;
use Telegram\Kernel\RequestInterface;

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
            throw new Exception('Invalid message');
        }

        $chat = $message->getChat();

        if (!$chat instanceof Chat) {
            throw new Exception('Invalid chat');
        }

        $request->sendMessage($chat->getId(), 'Hello, world!');
    }
}
