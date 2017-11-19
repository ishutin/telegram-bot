<?php

namespace Telegram\Handler;

use Telegram\Request;
use Telegram\Response;

interface Handler
{
    public function handle(Request $request, Response $response);
}
