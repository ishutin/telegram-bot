<?php

namespace Telegram\Entity;

/**
 * Trait FileEntityTrait
 * @package Telegram\Entity
 *
 * @property int $fileSize
 */
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
