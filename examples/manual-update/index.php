<?php

use Telegram\Kernel\Exception\EntityParserException;
use Telegram\Handler\Update\AbstractUpdateHandler;
use Telegram\Handler\Update\ManualUpdateHandler;
use Telegram\Kernel\Request;

require_once '../../vendor/autoload.php';

$token = 'xxxx-xxxx-xxxx-xxxx'; // your bot token
$request = new Request($token); // Create requester class

$updateHandler = new ManualUpdateHandler($request); // update handler

// handlers listen events MESSAGE and EDITED MESSAGE
$updateHandler
    ->on(AbstractUpdateHandler::EVENT_MESSAGE, new MessageEventHandler())
    ->on(AbstractUpdateHandler::EVENT_EDITED_MESSAGE, new EditedMessageEventHandler());

try {
    $updateHandler->handle();
} catch (EntityParserException $e) {
    // catch exceptions
}
