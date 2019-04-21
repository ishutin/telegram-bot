<?php

namespace Telegram\Entity\Traits;

trait FileWidthAndHeightTrait
{
    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}
