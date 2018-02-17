<?php

use Telegram\{
    Entity\Update, Handler\EventHandlerInterface, Kernel\RequestInterface
};

class MessageEventHandler implements EventHandlerInterface
{
    public function handle(RequestInterface $request, Update $update): void
    {
        $toChat = $update->getMessage()->getChat();

        $request->sendMessage($toChat, 'Hello, world!');
    }
}