<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\{FileDurationTrait, FileMimeTrait, FileSizeTrait, FileTrait};

class Audio extends Entity
{
    use FileTrait;
    use FileDurationTrait;
    use FileSizeTrait;
    use FileMimeTrait;

    /**
     * @var string
     */
    protected $performer;

    /**
     * @var string
     */
    protected $title;

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
