<?php

namespace Telegram\Handler;

use Telegram\Entity\Update;
use Telegram\Kernel\Exception\EntityParserException;
use Telegram\Kernel\RequestInterface;

interface EventHandlerInterface
{
    /**
     * @param RequestInterface $request
     * @param Update $update
     *
     * @throws EntityParserException
     */
    public function handle(RequestInterface $request, Update $update): void;
}
