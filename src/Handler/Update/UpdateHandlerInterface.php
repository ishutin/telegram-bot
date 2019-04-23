<?php

namespace Telegram\Handler\Update;

use Telegram\Entity\Update;
use Telegram\Kernel\Exception\EntityParserException;

interface UpdateHandlerInterface
{
    /**
     * @return Update[]
     *
     * @throws EntityParserException
     */
    public function getUpdates(): array;
}
