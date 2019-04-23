<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\FileDurationTrait;
use Telegram\Entity\Traits\FileMimeTrait;
use Telegram\Entity\Traits\FileSizeTrait;
use Telegram\Entity\Traits\FileThumbTrait;
use Telegram\Entity\Traits\FileTrait;
use Telegram\Entity\Traits\FileWidthAndHeightTrait;

class Video
{
    use FileTrait;
    use FileDurationTrait;
    use FileSizeTrait;
    use FileMimeTrait;
    use FileWidthAndHeightTrait;
    use FileThumbTrait;

    public function __construct(
        string $fileId,
        int $width,
        int $height,
        int $duration
    ) {
        $this->fileId = $fileId;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
    }
}
