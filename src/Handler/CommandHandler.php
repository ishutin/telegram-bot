<?php

namespace Telegram\Handler;

use Telegram\Entity\MessageEntity;
use Telegram\Exception\HandlerException;
use Telegram\Kernel\RequestInterface;
use Telegram\Kernel\ResponseInterface;

class CommandHandler implements HandlerInterface
{
    /**
     * @var ActionInterface[]
     */
    private $commandActionsList = [];

    public function handle(RequestInterface $request, ResponseInterface $response): void
    {
        if (empty($this->commandActionsList)) {
            throw new HandlerException('Invalid handler actions');
        }

        $message = $request->getMessage();

        // commands in request
        $commands = $message->getEntitiesValues(MessageEntity::TYPE_BOT_COMMAND);

        foreach ($commands as $command) {
            if (isset($this->commandActionsList[$command])) {
                $handler = $this->commandActionsList[$command];
                $handler->execute($request, $response);
            }
        }
    }

    public function on(string $command, ActionInterface $action): void
    {
        $this->commandActionsList[$command] = $action;
    }

}
