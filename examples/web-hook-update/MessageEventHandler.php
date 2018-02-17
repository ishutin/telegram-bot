<?php

use Telegram\Entity\Update;
use Telegram\Handler\Update\EventHandlerInterface;
use Telegram\Kernel\RequestInterface;

class MessageEventHandler implements EventHandlerInterface
{
    public function handle(RequestInterface $request, Update $update): void
    {
        $toChat = $update->getMessage()->getChat();

        $request->sendMessage($toChat, 'Hello, world!');
    }
}