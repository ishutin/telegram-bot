<?php

use Example\EditedMessageEventHandler;
use Example\MessageEventHandler;
use Telegram\Event\EventStorageInterface;
use Telegram\Handler\Update\ManualUpdateHandlerInterface;
use Telegram\Kernel\Telegram;

require_once __DIR__ . '/../vendor/autoload.php';

$token = 'xxxx-xxxx-xxxx-xxxx'; // your bot token
g
$telegram = new Telegram($token, ManualUpdateHandlerInterface::class);

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
