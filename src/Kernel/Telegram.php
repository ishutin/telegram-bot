<?php

namespace Telegram\Kernel;

use Telegram\Event\EventDispatcher;
use Telegram\Event\EventDispatcherInterface;
use Telegram\Event\EventStorage;
use Telegram\Event\EventStorageInterface;
use Telegram\Handler\Update\ManualUpdateHandler;
use Telegram\Handler\Update\ManualUpdateHandlerInterface;
use Telegram\Handler\Update\UpdateHandlerInterface;
use Telegram\Handler\Update\WebHookUpdateHandler;
use Telegram\Handler\Update\WebHookUpdateHandlerInterface;
use Telegram\Kernel\Exception\InvalidUpdateHandler;
use Telegram\Kernel\Exception\MissingUpdateHandler;

class Telegram implements TelegramInterface
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $updateHandlerClass;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var UpdateHandlerInterface
     */
    private $updateHandler;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var EventStorageInterface
     */
    private $eventStorage;

    public function __construct(string $token, string $updateHandlerClass = null)
    {
        $this->token = $token;
        $this->updateHandlerClass = $updateHandlerClass;
    }

    public function setUpdateHandler(UpdateHandlerInterface $updateHandler): TelegramInterface
    {
        $this->updateHandler = $updateHandler;

        return $this;
    }

    public function setRequest(RequestInterface $request): TelegramInterface
    {
        $this->request = $request;

        return $this;
    }

    public function setEventStorage(EventStorageInterface $eventStorage): TelegramInterface
    {
        $this->eventStorage = $eventStorage;

        return $this;
    }

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher): TelegramInterface
    {
        $this->eventDispatcher = $eventDispatcher;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUpdateHandler()
    {
        if ($this->updateHandler === null) {
            if ($this->updateHandlerClass === null) {
                throw new MissingUpdateHandler('Missing update handler');
            }

            $this->updateHandler = $this->getUpdateHandlerInstance($this->updateHandlerClass);
        }

        return $this->updateHandler;
    }

    public function getRequest(): RequestInterface
    {
        if ($this->request === null) {
            $this->request = new Request($this->token);
        }

        return $this->request;
    }

    public function getEventStorage(): EventStorageInterface
    {
        if ($this->eventStorage === null) {
            $this->eventStorage = new EventStorage();
        }

        return $this->eventStorage;
    }

    public function getEventDispatcher(): EventDispatcherInterface
    {
        if ($this->eventDispatcher === null) {
            $this->eventDispatcher = new EventDispatcher($this->getEventStorage());
        }

        return $this->eventDispatcher;
    }


    /**
     * @inheritDoc
     */
    public function listen(): void
    {
        foreach ($this->getUpdateHandler()->getUpdates() as $update) {
            $this->getEventDispatcher()->dispatch($this->request, $update);
        }
    }

    /**
     * @param string $updateHandlerClass
     * @return UpdateHandlerInterface
     */
    private function getUpdateHandlerInstance(string $updateHandlerClass): UpdateHandlerInterface
    {
        switch ($updateHandlerClass) {
            case ManualUpdateHandler::class:
            case ManualUpdateHandlerInterface::class:
                return new ManualUpdateHandler($this->getRequest());
            case WebHookUpdateHandler::class:
            case WebHookUpdateHandlerInterface::class:
                return new WebHookUpdateHandler();
            default:
                throw new InvalidUpdateHandler("Invalid update handler: $updateHandlerClass");
        }
    }
}
