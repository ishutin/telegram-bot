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

require_once 'vendor/autoload.php';

$token = 'XXX-XXX-XXX-XXX'; // use bot token

// use \Telegram\Kernel\Request class or your own realisation \Telegram\Kernel\RequestInterface
$request = new \Telegram\Kernel\Request(json_decode(file_get_contents('php://input'), true));
// use \Telegram\Kernel\Response class or your own realisation \Telegram\Kernel\ResponseInterface
$response = new \Telegram\Kernel\Response($token);

$kernel = new \Telegram\Kernel\Kernel($request, $response);

// commands handler
$commandHandler = new \Telegram\Handler\CommandHandler();
// handle '/test' command
$commandHandler->on('/test', new class implements \Telegram\Handler\ActionInterface
{
    public function execute(
        \Telegram\Kernel\RequestInterface $request, 
        \Telegram\Kernel\ResponseInterface $response
        
    ): void {
        $response->sendMessage(
            $request->getMessage()->getChat(),
            'User send /test command'
        );
    }
});

// text handler
$textHandler = new \Telegram\Handler\TextHandler();
// handler all text messages
$textHandler->on(new class implements \Telegram\Handler\ActionInterface
{
    public function execute(
        \Telegram\Kernel\RequestInterface $request, 
        \Telegram\Kernel\ResponseInterface $response
        
    ): void {
        $response->sendMessage(
            $request->getMessage()->getChat(),
            'User send some text. Answer him'
        );
    }
});

// ... and more handlers (and your own realisation \Telegram\Handler\HandlerInterface)

// register handlers
$kernel->pushHandler($commandHandler);
$kernel->pushHandler($textHandler);

// run bot
$kernel->run();
```
