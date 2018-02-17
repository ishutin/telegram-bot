<?php

namespace Telegram\Entity\Traits;

trait FileDurationTrait
{
    /**
     * @var int
     */
    protected $duration;

    public function getDuration(): int
    {
        return $this->duration;
    }
}