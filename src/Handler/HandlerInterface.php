<?php

namespace Telegram\Handler;

interface HandlerInterface
{
    public function listen(): void;
}
