<?php

namespace Telegram\Event;

use Telegram\HandlerInterface;

class CommandEvent extends Event
{
    /**
     * @var HandlerInterface[]
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

    public function on(string $command, HandlerInterface $handler): self
    {
        $this->commandsList[$command] = $handler;

        return $this;
    }

}
