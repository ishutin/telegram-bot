<?php

namespace Telegram\Entity;

/**
 * Class Audio
 * @package Telegram\Entity
 *
 * @property string $id
 * @property int $duration
 * @property string $performer
 * @property string $title
 * @property string $mimeType
 * @property int $fileSize
 */
class Audio extends Entity
{
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

    /**
     * @var int
     */
    private $fileSize;

    public function __construct(string $id, int $duration)
    {
        $this->id = $id;
        $this->duration = $duration;
    }

    public function getId(): string
    {
        return $this->id;
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

    public function getFileSize():? int
    {
        return $this->fileSize;
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

    public function setFileSize(int $fileSize = null): void
    {
        $this->fileSize = $fileSize;
    }
}
