<?php

namespace Telegram;

use Telegram\Request;
use Telegram\Response;

interface HandlerInterface
{
    public function handle(Request $request, Response $response);
}
