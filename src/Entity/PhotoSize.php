<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\FileSizeTrait;
use Telegram\Entity\Traits\FileTrait;
use Telegram\Entity\Traits\FileWidthAndHeightTrait;

class PhotoSize
{
    use FileTrait;
    use FileWidthAndHeightTrait;
    use FileSizeTrait;

    public function __construct(string $fileId, int $width, int $height)
    {
        $this->fileId = $fileId;
        $this->width = $width;
        $this->height = $height;
    }
}
