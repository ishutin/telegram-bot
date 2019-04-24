<?php

namespace Telegram\Entity\Traits;

trait FileLengthTrait
{
    /**
     * @var int
     */
    private $length;

    public function getLength(): int
    {
        return $this->length;
    }
}
