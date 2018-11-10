<?php

namespace Telegram\Entity\Traits;

trait FileSizeTrait
{
    /**
     * @var int
     */
    protected $fileSize;

    public function setFileSize(int $fileSize = null): void
    {
        $this->fileSize = $fileSize;
    }

    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }
}