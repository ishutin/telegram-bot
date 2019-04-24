<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\{FileMimeTrait, FileNameTrait, FileSizeTrait, FileThumbTrait, FileTrait};

class Document
{
    use FileTrait;
    use FileSizeTrait;
    use FileMimeTrait;
    use FileThumbTrait;
    use FileNameTrait;

    public function __construct(string $fileId)
    {
        $this->fileId = $fileId;
    }
}
