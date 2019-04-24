<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\{FileMimeTrait, FileSizeTrait, FileThumbTrait, FileTrait};

class Document
{
    use FileTrait;
    use FileSizeTrait;
    use FileMimeTrait;
    use FileThumbTrait;

    /**
     * @var string
     */
    private $fileName;

    public function __construct(string $fileId)
    {
        $this->fileId = $fileId;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName = null): void
    {
        $this->fileName = $fileName;
    }
}
