<?php

namespace Telegram\Handler;

use Telegram\Request;
use Telegram\Response;

abstract class CommandHandler
{
    abstract public function handle(Request $request, Response $response);
}
