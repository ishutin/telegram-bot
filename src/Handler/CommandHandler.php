<?php

namespace Telegram\Handler;

use Telegram\Entity\MessageEntity;
use Telegram\RequestInterface;
use Telegram\ResponseInterface;

class CommandHandler implements HandlerInterface
{
    /**
     * @var ActionInterface[]
     */
    private $commandEventsList = [];

    public function handle(RequestInterface $request, ResponseInterface $response): void
    {
        $message = $request->getMessage();

        // commands in request
        $commands = $message->getEntitiesValues(MessageEntity::TYPE_BOT_COMMAND);

        foreach ($commands as $command) {
            if (isset($this->commandEventsList[$command])) {
                $handler = $this->commandEventsList[$command];
                $handler->handle($request, $response);
            }
        }
    }

    public function on(string $command, ActionInterface $event): void
    {
        $this->commandEventsList[$command] = $event;
    }

}
