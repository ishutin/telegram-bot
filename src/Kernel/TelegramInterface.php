<?php

namespace Telegram\Kernel;

use Telegram\Entity\Factory\EntityFactoryInterface;
use Telegram\Event\EventDispatcherInterface;
use Telegram\Event\EventStorageInterface;
use Telegram\Handler\Update\ManualUpdateHandlerInterface;
use Telegram\Handler\Update\UpdateHandlerInterface;
use Telegram\Handler\Update\WebHookUpdateHandlerInterface;
use Telegram\Http\Exception\HttpRequestException;
use Telegram\Http\Exception\MissingEntityFactory;
use Telegram\Http\RequestInterface;
use Telegram\Kernel\Exception\MissingUpdateHandler;

interface TelegramInterface
{
    public function setUpdateHandler(UpdateHandlerInterface $updateHandler): TelegramInterface;

    public function setRequest(RequestInterface $request): TelegramInterface;

    public function setEventStorage(EventStorageInterface $eventStorage): TelegramInterface;

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher): TelegramInterface;

    public function setEntityFactory(EntityFactoryInterface $entityFactory): TelegramInterface;

    public function getRequest(): RequestInterface;

    public function getEventStorage(): EventStorageInterface;

    public function getEventDispatcher(): EventDispatcherInterface;

    /**
     * @return UpdateHandlerInterface|WebHookUpdateHandlerInterface|ManualUpdateHandlerInterface
     * @throws MissingUpdateHandler
     */
    public function getUpdateHandler();

    public function getEntityFactory(): EntityFactoryInterface;

    /**
     * @throws \Telegram\Entity\Factory\Exception\ParseException
     * @throws MissingUpdateHandler
     * @throws MissingEntityFactory
     * @throws HttpRequestException
     */
    public function listen(): void;
}
