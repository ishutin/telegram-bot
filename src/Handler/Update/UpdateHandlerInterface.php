<?php

namespace Telegram\Handler\Update;

use Telegram\Entity\Update\Update;
use Telegram\Http\Exception\HttpRequestException;
use Telegram\Http\Exception\MissingEntityFactory;

interface UpdateHandlerInterface
{
    /**
     * @return Update[]|null
     * @throws HttpRequestException
     * @throws MissingEntityFactory
     */
    public function getUpdates():? array;
}
