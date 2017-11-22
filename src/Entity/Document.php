<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\FileSizeAttributeTrait;
use Telegram\Entity\Traits\MimeAttributeTrait;

class Document extends Entity
{
    use FileSizeAttributeTrait;
    use MimeAttributeTrait;

    /**
     * @var string
     */
    private $fileId;

    /**
     * @var Photo
     */
    private $thumb;

    /**
     * @var string
     */
    private $fileName;

    public function __construct(string $fileId)
    {
        $this->fileId = $fileId;
    }

    public function getFileId(): string
    {
        return $this->fileId;
    }

    public function getThumb():? Photo
    {
        return $this->thumb;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setThumb(Photo $photo = null): void
    {
        $this->thumb = $photo;
    }

    public function setFileName(string $fileName = null): void
    {
        $this->fileName = $fileName;
    }
}
