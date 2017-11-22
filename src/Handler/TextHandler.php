<?php

namespace Telegram\Handler;

use Telegram\Exception\HandlerException;
use Telegram\Kernel\RequestInterface;
use Telegram\Kernel\ResponseInterface;

class TextHandler implements HandlerInterface
{
    /**
     * @var ActionInterface
     */
    private $action;

    public function handle(RequestInterface $request, ResponseInterface $response): void
    {
        if (empty($this->action)) {
            throw new HandlerException('Invalid handler action');
        }

        $message = $request->getMessage();

        $isCommand = false;

        foreach ($message->entities as $entity) {
            if ($entity->type == $entity::TYPE_BOT_COMMAND) {
                $isCommand = true;
                break;
            }
        }

        if ($text = $message->text && !$isCommand) {
            $this->action->handle($request, $response);
        }
    }

    public function on(ActionInterface $action): void
    {
        $this->action = $action;
    }
}
