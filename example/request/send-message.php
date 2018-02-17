<?php

use Telegram\{
    Entity\Chat, Kernel\Request
};

require_once '../../vendor/autoload.php';

$token = 'xxxx-xxxx-xxxx-xxxx';

// class Request can be used singly for requests
$request = new Request($token);

// Chat entity
$chat = new Chat('example-chat-id', Chat::TYPE_PRIVATE_CHAT);

$request->sendMessage($chat, 'hello world');