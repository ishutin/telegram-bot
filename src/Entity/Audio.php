<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\{FileDurationTrait, FileMimeTrait, FileSizeTrait, FileThumbTrait, FileTrait};

class Audio
{
    use FileTrait;
    use FileDurationTrait;
    use FileSizeTrait;
    use FileMimeTrait;
    use FileThumbTrait;

    /**
     * @var string
     */
    private $performer;

    /**
     * @var string
     */
    private $title;

    public function __construct(string $fileId, int $duration)
    {
        $this->fileId = $fileId;
        $this->duration = $duration;
    }

    public function getPerformer(): ?string
    {
        return $this->performer;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setPerformer(string $performer = null): void
    {
        $this->performer = $performer;
    }

    public function setTitle(string $title = null): void
    {
        $this->title = $title;
    }
}
