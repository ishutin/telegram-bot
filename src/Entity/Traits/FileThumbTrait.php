<?php

namespace Telegram\Entity\Traits;

use Telegram\Entity\PhotoSize;

trait FileThumbTrait
{
    /**
     * @var PhotoSize|null
     */
    private $thumb;

    public function getThumb(): ?PhotoSize
    {
        return $this->thumb;
    }

    public function setThumb(?PhotoSize $thumb): void
    {
        $this->thumb = $thumb;
    }
}
