<?php

use Telegram\Handler\Update\AbstractUpdateHandler;
use Telegram\Handler\Update\WebHookUpdateHandler;
use Telegram\Kernel\Kernel;
use Telegram\Kernel\Request;

require_once '../../vendor/autoload.php';

// Init app
$app = new Kernel();

// Create requester class
$token = 'xxxx-xxxx-xxxx-xxxx';
$request = new Request($token);

$updateHandler = new WebHookUpdateHandler($request);

// handlers listen events MESSAGE and EDITED MESSAGE
$updateHandler
    ->on(AbstractUpdateHandler::EVENT_MESSAGE, new MessageEventHandler())
    ->on(AbstractUpdateHandler::EVENT_EDITED_MESSAGE, new EditedMessageEventHandler());

// attach update handler to app
$app->attachHandler($updateHandler);

// run application
$app->run();