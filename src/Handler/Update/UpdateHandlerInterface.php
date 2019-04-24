<?php

namespace Telegram\Handler\Update;

use Telegram\Entity\Update\Update;

interface UpdateHandlerInterface
{
    /**
     * @return Update[]
     */
    public function getResponseData(): array;
}
