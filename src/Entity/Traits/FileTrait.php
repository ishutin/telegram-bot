<?php

namespace Telegram\Entity\Traits;

trait FileTrait
{
    /**
     * @var string
     */
    private $fileId;

    public function getFileId(): string
    {
        return $this->fileId;
    }
}
