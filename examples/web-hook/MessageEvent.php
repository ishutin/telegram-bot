<?php

use Telegram\{
    Entity\Update, Kernel\RequestInterface
};

class MessageEvent implements \Telegram\Handler\EventInterface
{
    public function handle(RequestInterface $request, Update $update): void
    {
        $toChat = $update->getMessage()->getChat();

        $request->sendMessage($toChat, 'Hello, world!');
    }
}