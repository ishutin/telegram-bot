# telegram-bot (Alpha version)

## Description

High-performance and flexible library for [Telegram Bot API](https://core.telegram.org/bots/api).


## Installing

Minimal PHP version: **7.1**


```bash
composer require ishutin/telegram-bot:dev-master
```


## Example

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

$token = 'xxxx-xxxx-xxxx-xxxx';
// class Request can be used singly for requests
$request = new Request($token);

// you can use ManualHandler or WebHookHandler
// more details https://core.telegram.org/bots/api#getting-updates
$updateHandler = new WebHookHandler();
$app = new Kernel($request, $updateHandler);

// an anonymous class is used for an example
$actionHandler = new class implements ActionInterface
{
    public function run(RequestInterface $request, Update $update): void
    {
        $toChat = $update->getMessage()->getChat();

        $request->sendMessage($toChat, 'Hello, world!');
    }
};

$handler = (new UpdateEventHandler())
    ->on(UpdateEventHandler::EVENT_MESSAGE, $actionHandler); // Handle all messages

// attach UpdateEventHandler to app
$app->attachHandler($handler);

$app->run();

```
