<?php

namespace Telegram\Handler;

use Telegram\Bot;

abstract class Handler implements HandlerInterface
{
    /**
     * @var Bot
     */
    protected $bot;

    public function __construct(Bot $bot)
    {
        $this->bot = $bot;
    }
}
