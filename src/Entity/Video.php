<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\{
    FileDurationTrait, FileSizeTrait, FileTrait, FileMimeTrait
};

class Video extends Entity
{
    use FileTrait;
    use FileDurationTrait;
    use FileSizeTrait;
    use FileMimeTrait;

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
