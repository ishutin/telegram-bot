<?php

namespace Telegram\Entity;

trait FileSizeEntityTrait
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
