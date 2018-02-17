<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\{
    FileDurationTrait, FileSizeTrait, FileMimeTrait, FileTrait
};

class Voice extends Entity
{
    use FileTrait;
    use FileDurationTrait;
    use FileSizeTrait;
    use FileMimeTrait;

    public function __construct(string $fileId, int $duration)
    {
        $this->fileId = $fileId;
        $this->duration = $duration;
    }
}
