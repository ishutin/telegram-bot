<?

use Telegram\{
    Handler\Event, Kernel\Handler\WebHookHandler, Kernel\Kernel, Kernel\Request
};

require_once '../../vendor/autoload.php';

$token = 'xxxx-xxxx-xxxx-xxxx';

$request = new Request($token);
$updateHandler = new WebHookHandler();

// Init app
$app = new Kernel($request, $updateHandler);

// handlers listen events MESSAGE and EDITED MESSAGE
$handler = (new Event())
    ->on(Event::EVENT_MESSAGE, new MessageEventHandler())
    ->on(Event::EVENT_EDITED_MESSAGE, new EditedMessageEventHandler());

// attach event handler to app
$app->attachHandler($handler);

// run application
$app->run();