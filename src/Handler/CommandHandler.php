<?php

namespace Telegram\Handler;

use Telegram\EventInterface;

class CommandHandler extends Handler
{
    /**
     * @var EventInterface[]
     */
    private $commandsList = [];

    public function listen()
    {
        $bot = $this->bot;
        $message = $bot->getRequest()->getMessage();

        foreach ($message->getEntities() as $entity) {
            if ($entity->getType() === $entity::TYPE_BOT_COMMAND) {
                $commandOnText = substr(
                    $message->getText(),
                    $entity->getOffset(), $entity->getLength()
                );

                if (isset($this->commandsList[$commandOnText])) {
                    $handler = $this->commandsList[$commandOnText];
                    $handler->handle($bot->getRequest(), $bot->getResponse());

                    break;
                }
            }
        }
    }

    public function on(string $command, EventInterface $event)
    {
        $this->commandsList[$command] = $event;
    }

}
