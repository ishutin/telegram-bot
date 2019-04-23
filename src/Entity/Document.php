<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\{FileMimeTrait, FileSizeTrait, FileTrait};

class Document
{
    use FileTrait;
    use FileSizeTrait;
    use FileMimeTrait;

    /**
     * @var Photo
     */
    protected $thumb;

    /**
     * @var string
     */
    protected $fileName;

    public function __construct(string $fileId)
    {
        $this->fileId = $fileId;
    }

    public function getThumb(): ?Photo
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
