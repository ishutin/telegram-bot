<?php

namespace Telegram\Handler\Update;

use Telegram\Entity\Update;

interface UpdateHandlerInterface
{
    /**
     * @return Update[]
     */
    public function getResponseData(): array;
}
