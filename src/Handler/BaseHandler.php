<?php

namespace Telegram\Handler;

use Telegram\Bot;

abstract class BaseHandler
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
