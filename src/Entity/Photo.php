<?php

namespace Telegram\Entity;

class Photo extends Entity
{
    use FileSizeEntityTrait;

    /**
     * @var string
     */
    private $fileId;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

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
