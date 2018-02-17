<?

use Telegram\{
    Handler\EventHandler, Kernel\Handler\WebHookHandler, Kernel\Kernel, Kernel\Request
};

require_once '../../vendor/autoload.php';

$token = 'xxxx-xxxx-xxxx-xxxx';

$request = new Request($token);
$updateHandler = new WebHookHandler();

// Init app
$app = new Kernel($request, $updateHandler);

// handler listen events MESSAGE and EDITED MESSAGE
$handler = (new EventHandler())
    ->on(EventHandler::EVENT_MESSAGE, new MessageEvent())
    ->on(EventHandler::EVENT_EDITED_MESSAGE, new EditedMessageEvent());

// attach event handler to app
$app->attachHandler($handler);

// run application
$app->run();