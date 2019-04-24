<?php

namespace Telegram\Entity\Traits;

trait FileDurationTrait
{
    /**
     * @var int
     */
    private $duration;

    public function getDuration(): int
    {
        return $this->duration;
    }
}
