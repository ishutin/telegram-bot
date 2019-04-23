<?php

use Telegram\Http\Exception\HttpRequestException;
use Telegram\Http\Request;

require_once '../vendor/autoload.php';

$token = 'xxxx-xxxx-xxxx-xxxx';

$request = new Request($token); // class Request can be used singly for requests

try {
    $request->sendMessage('example-chat-id', 'hello world');
} catch (HttpRequestException $e) {
    // catch exceptions
}
