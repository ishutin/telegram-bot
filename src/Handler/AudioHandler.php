<?php

namespace Telegram\Handler;

use Telegram\Entity\Audio;
use Telegram\Exception\HandlerException;
use Telegram\Kernel\RequestInterface;
use Telegram\Kernel\ResponseInterface;

class AudioHandler implements HandlerInterface
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

        if ($request->getMessage()->getAudio() instanceof Audio) {
            $this->action->execute($request, $response);
        }
    }

    public function on(ActionInterface $action): void
    {
        $this->action = $action;
    }
}
