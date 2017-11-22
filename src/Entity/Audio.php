<?php

namespace Telegram\Entity;

class Audio extends Entity
{
    use FileSizeEntityTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $duration;

    /**
     * @var string
     */
    private $performer;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $mimeType;

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

    public function getMimeType():? string
    {
        return $this->mimeType;
    }

    public function setPerformer(string $performer = null): void
    {
        $this->performer = $performer;
    }

    public function setTitle(string $title = null): void
    {
        $this->title = $title;
    }

    public function setMimeType(string $mimeType = null): void
    {
        $this->mimeType = $mimeType;
    }
}
