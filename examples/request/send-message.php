<?php

use Telegram\Entity\Chat;
use Telegram\Kernel\Request;

require_once '../../vendor/autoload.php';

$token = 'xxxx-xxxx-xxxx-xxxx';

$request = new Request($token); // class Request can be used singly for requests

$request->sendMessage('example-chat-id', 'hello world'); // send message