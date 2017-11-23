# telegram-bot (Alpha version)

## Description

High-performance and flexible library for [Telegram Bot API](https://core.telegram.org/bots/api).


## Installing

Minimal PHP version: **7.1**


```bash
composer require ishutin/telegram-bot:dev-master
```


## Usage

```php
<?php

use Telegram\Entity\Update;
use Telegram\Handler\ActionInterface;
use Telegram\Handler\UpdateEventHandler;
use Telegram\Kernel\Handler\WebHookHandler;
use Telegram\Kernel\Kernel;
use Telegram\Kernel\Request;
use Telegram\Kernel\RequestInterface;

require_once 'vendor/autoload.php';

// class Request can be used singly for requests
$request = new Request('487878994:AAGTwRIljsXImb2No_fBfqQ4yd_1dqqTMQs');

// you can use ManuallyHandler or WebHookHandler
$updateHandler = new WebHookHandler();
$app = new Kernel($request, $updateHandler);

$handler = (new UpdateEventHandler())
    ->on(
        UpdateEventHandler::EVENT_MESSAGE,
        new class implements ActionInterface
        {
            public function run(
                RequestInterface $request,
                Update $update
            ): void {
                $request->sendMessage(
                    $update->getMessage()->getChat(),
                    'Hello, world!'
                );
            }
        }
    );

// Attach UpdateEventHandler to app
$app->attachHandler($handler);

$app->run();
```
