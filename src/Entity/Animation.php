<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\FileDurationTrait;
use Telegram\Entity\Traits\FileMimeTrait;
use Telegram\Entity\Traits\FileNameTrait;
use Telegram\Entity\Traits\FileSizeTrait;
use Telegram\Entity\Traits\FileThumbTrait;
use Telegram\Entity\Traits\FileTrait;
use Telegram\Entity\Traits\FileWidthAndHeightTrait;

class Animation
{
    use FileTrait;
    use FileDurationTrait;
    use FileWidthAndHeightTrait;
    use FileMimeTrait;
    use FileSizeTrait;
    use FileThumbTrait;
    use FileNameTrait;

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
