<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\{FileSizeTrait, FileTrait, FileWidthAndHeightTrait};

class Photo
{
    use FileTrait;
    use FileSizeTrait;
    use FileWidthAndHeightTrait;

    public function __construct(string $fileId, int $width, int $height)
    {
        $this->fileId = $fileId;
        $this->width = $width;
        $this->height = $height;
    }
}
