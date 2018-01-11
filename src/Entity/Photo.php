<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\FileSizeAttributeTrait;

class Photo extends Entity
{
    use FileSizeAttributeTrait;

    /**
     * @var string
     */
    protected $fileId;

    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    public function __construct(
        string $fileId,
        int $width,
        int $height
    ) {
        $this->fileId = $fileId;
        $this->width = $width;
        $this->height = $height;
    }

    public function getFileId(): string
    {
        return $this->fileId;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}
