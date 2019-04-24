<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\FileDurationTrait;
use Telegram\Entity\Traits\FileLengthTrait;
use Telegram\Entity\Traits\FileSizeTrait;
use Telegram\Entity\Traits\FileThumbTrait;
use Telegram\Entity\Traits\FileTrait;

class VideoNote
{
    use FileTrait;
    use FileThumbTrait;
    use FileSizeTrait;
    use FileDurationTrait;
    use FileLengthTrait;

    public function __construct(string $fileId, int $length, int $duration)
    {
        $this->fileId = $fileId;
        $this->length = $length;
        $this->duration = $duration;
    }
}
