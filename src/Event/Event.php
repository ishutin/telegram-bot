<?php

namespace Telegram\Event;

use Telegram\Bot;

abstract class Event
{
    /**
     * @var Bot
     */
    protected $bot;

    public function __construct(Bot $bot)
    {
        $this->bot = $bot;
    }

    abstract public function listen();
}
