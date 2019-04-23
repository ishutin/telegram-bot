<?php

use Telegram\Kernel\Exception\RequestException;
use Telegram\Kernel\Request;

require_once '../../vendor/autoload.php';

$token = 'xxxx-xxxx-xxxx-xxxx';

$request = new Request($token); // class Request can be used singly for requests

try {
    $request->sendMessage('example-chat-id', 'hello world');
} catch (RequestException $e) {
    // catch exceptions
}
