<?php

use Example\EditedMessageEventHandler;
use Example\MessageEventHandler;
use Telegram\Event\EventStorageInterface;
use Telegram\Handler\Update\WebHookUpdateHandlerInterface;
use Telegram\Kernel\Telegram;

require_once '../vendor/autoload.php';

$token = 'xxxx-xxxx-xxxx-xxxx'; // your bot token

$telegram = new Telegram($token, WebHookUpdateHandlerInterface::class);

try {
    // Handle events
    $telegram
        ->getEventStorage()
        ->on(EventStorageInterface::EVENT_MESSAGE, new MessageEventHandler())
        ->on(EventStorageInterface::EVENT_EDITED_MESSAGE, new EditedMessageEventHandler());

    $telegram->listen();
} catch (Throwable $exception) {
    echo $exception->getMessage();
}
