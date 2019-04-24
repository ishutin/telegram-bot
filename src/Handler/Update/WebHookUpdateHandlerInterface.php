<?php

namespace Telegram\Handler\Update;

use Telegram\Entity\Factory\EntityFactoryInterface;

interface WebHookUpdateHandlerInterface extends UpdateHandlerInterface
{
    public function setEntityFactory(EntityFactoryInterface $entityFactory): WebHookUpdateHandlerInterface;

    public function getEntityFactory(): EntityFactoryInterface;
}
