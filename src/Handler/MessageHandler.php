<?php

namespace Telegram\Handler;

use Telegram\Entity\Update;
use Telegram\Kernel\RequestInterface;

class MessageHandler extends AbstractHandler
{
    public function handle(RequestInterface $request, Update $update): void
    {
        if ($update->getMessage()) {
            $this->action->run($request, $update);
        }
    }
}
