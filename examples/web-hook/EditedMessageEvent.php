<?php

use Telegram\{
    Entity\Update, Handler\EventInterface, Kernel\RequestInterface
};

class EditedMessageEvent implements EventInterface
{
    public function handle(RequestInterface $request, Update $update): void
    {
        $toChat = $update->getMessage()->getChat();

        $request->sendMessage($toChat, 'You changed message!');
    }
}