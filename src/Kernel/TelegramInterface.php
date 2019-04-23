<?php

namespace Telegram\Kernel;

use Telegram\Event\EventDispatcherInterface;
use Telegram\Event\EventStorageInterface;
use Telegram\Handler\Update\ManualUpdateHandlerInterface;
use Telegram\Handler\Update\UpdateHandlerInterface;
use Telegram\Handler\Update\WebHookUpdateHandlerInterface;
use Telegram\Kernel\Exception\MissingUpdateHandler;

interface TelegramInterface
{
    public function setUpdateHandler(UpdateHandlerInterface $updateHandler): TelegramInterface;

    public function setRequest(RequestInterface $request): TelegramInterface;

    public function setEventStorage(EventStorageInterface $eventStorage): TelegramInterface;

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher): TelegramInterface;

    public function getRequest(): RequestInterface;

    public function getEventStorage(): EventStorageInterface;

    public function getEventDispatcher(): EventDispatcherInterface;

    /**
     * @return UpdateHandlerInterface|WebHookUpdateHandlerInterface|ManualUpdateHandlerInterface
     * @throws MissingUpdateHandler
     */
    public function getUpdateHandler();

    /**
     * @throws Exception\EntityParserException
     * @throws MissingUpdateHandler
     */
    public function listen(): void;
}
