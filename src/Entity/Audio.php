<?php

namespace Telegram\Entity;

use Telegram\Entity\Traits\FileSizeAttributeTrait;
use Telegram\Entity\Traits\MimeAttributeTrait;

class Audio extends Entity
{
    use FileSizeAttributeTrait;
    use MimeAttributeTrait;

    /**
     * @var string
     */
    protected $fileId;

    /**
     * @var int
     */
    protected $duration;

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

    public function getFileId(): string
    {
        return $this->fileId;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getPerformer():? string
    {
        return $this->performer;
    }

    public function getTitle():? string
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
