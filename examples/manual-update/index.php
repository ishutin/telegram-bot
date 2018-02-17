<?php

use Telegram\Handler\Update\AbstractUpdateHandler;
use Telegram\Handler\Update\ManualUpdateHandler;
use Telegram\Kernel\Kernel;
use Telegram\Kernel\Request;

require_once '../../vendor/autoload.php';

$app = new Kernel(); // init app

$token = 'xxxx-xxxx-xxxx-xxxx'; // your bot token
$request = new Request($token); // Create requester class

$updateHandler = new ManualUpdateHandler($request); // update handler

// handlers listen events MESSAGE and EDITED MESSAGE
$updateHandler
    ->on(AbstractUpdateHandler::EVENT_MESSAGE, new MessageEventHandler())
    ->on(AbstractUpdateHandler::EVENT_EDITED_MESSAGE, new EditedMessageEventHandler());

$app->attachHandler($updateHandler); // attach update handler to app

$app->run(); // run application