<?php

namespace Telegram\Entity\Passport;

use Telegram\Entity\Traits\FileTrait;

class PassportFile
{
    use FileTrait;

    /**
     * @var int
     */
    private $fileSize;

    /**
     * @var int
     */
    private $fileDate;

    public function __construct(string $fileId, int $fileSize, int $fileDate)
    {
        $this->fileId = $fileId;
        $this->fileSize = $fileSize;
        $this->fileDate = $fileDate;
    }

    /**
     * @return int
     */
    public function getFileSize(): int
    {
        return $this->fileSize;
    }

    /**
     * @return int
     */
    public function getFileDate(): int
    {
        return $this->fileDate;
    }
}
