<?php

namespace Telegram\Handler;

use Telegram\Entity\MessageEntity;
use Telegram\EventInterface;

class CommandHandler extends Handler
{
    /**
     * @var EventInterface[]
     */
    private $commandEventsList = [];

    public function listen()
    {
        $bot = $this->bot;
        $message = $bot->getRequest()->getMessage();

        // commands in request
        $commands = $message->getEntitiesValues(MessageEntity::TYPE_BOT_COMMAND);

        foreach ($commands as $command) {
            if (isset($this->commandEventsList[$command])) {
                $handler = $this->commandEventsList[$command];
                $handler->handle($bot->getRequest(), $bot->getResponse());
            }
        }
    }

    public function on(string $command, EventInterface $event)
    {
        $this->commandEventsList[$command] = $event;
    }

}
