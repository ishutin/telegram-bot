<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\{FileDurationTrait, FileMimeTrait, FileSizeTrait, FileTrait, FileWidthAndHeightTrait};

class Video extends Entity
{
    use FileTrait;
    use FileDurationTrait;
    use FileSizeTrait;
    use FileMimeTrait;
    use FileWidthAndHeightTrait;

    /**
     * @var Photo
     */
    protected $thumb;

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

    public function getThumb(): Photo
    {
        return $this->thumb;
    }

    public function setThumb(Photo $thumb): void
    {
        $this->thumb = $thumb;
    }
}
