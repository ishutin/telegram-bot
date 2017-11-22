<?php

namespace Telegram\Entity\Traits;

trait FileSizeAttributeTrait
{
    /**
     * @var int
     */
    private $fileSize;

    public function setFileSize(int $fileSize = null): void
    {
        $this->fileSize = $fileSize;
    }

    public function getFileSize():? int
    {
        return $this->fileSize;
    }
}
