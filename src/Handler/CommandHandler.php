<?php

namespace Telegram\Handler;

class CommandHandler extends BaseHandler
{
    public function listen(string $command, callable $callback): self
    {
        $bot = $this->bot;
        $message = $bot->getRequest()->getMessage();

        foreach ($message->getEntities() as $entity) {
            if ($entity->getType() === $entity::TYPE_BOT_COMMAND) {
                $commandOnText = substr(
                    $message->getText(),
                    $entity->getOffset(), $entity->getLength()
                );
                if ($commandOnText == $command) {
                    $callback($bot->getRequest(), $bot->getResponse());
                    break;
                }
            }
        }

        return $this;
    }

}
