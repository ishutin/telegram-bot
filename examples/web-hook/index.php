<?

use Telegram\{
    Handler\Update\AbstractUpdateHandler,
    Handler\Update\WebHookUpdateHandler,
    Kernel\Kernel,
    Kernel\Request
};

require_once '../../vendor/autoload.php';

$token = 'xxxx-xxxx-xxxx-xxxx';

$request = new Request($token);

// Init app
$app = new Kernel($request);

$updateHandler = new WebHookUpdateHandler();

// handlers listen events MESSAGE and EDITED MESSAGE
$updateHandler
    ->on(AbstractUpdateHandler::EVENT_MESSAGE, new MessageEventHandler())
    ->on(AbstractUpdateHandler::EVENT_EDITED_MESSAGE, new EditedMessageEventHandler());

// attach update handler to app
$app->attachHandler($updateHandler);

// run application
$app->run();