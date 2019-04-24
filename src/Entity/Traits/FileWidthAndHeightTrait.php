<?php

namespace Telegram\Entity\Traits;

trait FileWidthAndHeightTrait
{
    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}
