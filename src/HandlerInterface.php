<?php

namespace Telegram;

interface HandlerInterface
{
    public function handle(Request $request, Response $response);
}
