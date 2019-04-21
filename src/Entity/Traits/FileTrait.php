<?php

namespace Telegram\Entity\Traits;

trait FileTrait
{
    /**
     * @var string
     */
    protected $fileId;

    public function getFileId(): string
    {
        return $this->fileId;
    }
}
