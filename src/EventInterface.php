<?php

namespace Telegram;

interface EventInterface
{
    public function handle(Request $request, Response $response);
}
