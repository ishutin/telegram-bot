# telegram-bot

## Installing
```bash
composer require ishutin/telegram-bot:dev-master
```

## Usage
```php
// Bot
$token = 'XXX-XXX-XXX-XXX'; // use bot token
$config = new \Telegram\Config($token);
$bot = new \Telegram\Bot($config);

// commands handler
$commandHandler = new \Telegram\Handler\CommandHandler($bot);

// handle '/test' command
$commandHandler->on('/test', new class implements \Telegram\EventInterface
{
    public function handle(\Telegram\Request $request, \Telegram\Response $response)
    {
        $response->sendMessage(
            $request->getMessage()->getChat(),
            'User send /test command'
        );
    }
});


$textHandler = new \Telegram\Handler\TextHandler($bot);
$textHandler->on(new class implements \Telegram\EventInterface
{
    public function handle(\Telegram\Request $request, \Telegram\Response $response)
    {
        $response->sendMessage(
            $request->getMessage()->getChat(),
            'Ne ozhidal? Ya poyavilsya iz temnoti, bratishka'
        );
    }
});

// register handlers
$bot->pushHandler($commandHandler);
$bot->pushHandler($textHandler);

$bot->run();
```
