<?php

use Telegram\Http\Request;

require_once '../vendor/autoload.php';

$token = 'xxxx-xxxx-xxxx-xxxx'; // API token

$request = new Request($token); // class Request can be used singly for requests

try {
    $request->sendMessage('example-chat-id', 'hello world');
} catch (Throwable $e) {
    echo $exception->getMessage();
}
