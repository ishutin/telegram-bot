<?php

namespace Telegram;

interface EventInterface
{
    public function handle(
        RequestInterface $request,
        ResponseInterface $response
    ): void;
}
