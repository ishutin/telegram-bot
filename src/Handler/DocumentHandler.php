<?php

namespace Telegram\Handler;

use Telegram\Entity\Document;
use Telegram\Exception\HandlerException;
use Telegram\Kernel\RequestInterface;
use Telegram\Kernel\ResponseInterface;

class DocumentHandler implements HandlerInterface
{
    /**
     * @var ActionInterface
     */
    private $action;

    public function handle(RequestInterface $request, ResponseInterface $response): void
    {
        if (empty($this->action)) {
            throw new HandlerException('Invalid handler actions');
        }

        if ($request->getMessage()->getDocument() instanceof Document) {
            $this->action->execute($request, $response);
        }
    }

    public function on(ActionInterface $action)
    {
        $this->action = $action;
    }
}
