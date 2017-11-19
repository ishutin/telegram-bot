<?php

namespace Telegram\Event;

use Telegram\Bot;

abstract class Event implements EventInterface
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
