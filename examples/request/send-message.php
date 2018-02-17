<?php

use Telegram\Entity\Chat;
use Telegram\Kernel\Request;

require_once '../../vendor/autoload.php';

$token = 'xxxx-xxxx-xxxx-xxxx';

$request = new Request($token); // class Request can be used singly for requests

$chat = new Chat('examples-chat-id', Chat::TYPE_PRIVATE_CHAT); // Chat entity

$request->sendMessage($chat, 'hello world'); // send message