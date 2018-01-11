<?php

namespace Telegram\Entity;

class ChatPhoto extends Entity
{
    /**
     * @var string
     */
    protected $smallFileId;

    /**
     * @var string
     */
    protected $bigFileId;

    public function __construct(string $smallFileId, string $bigFileId)
    {
        $this->smallFileId = $smallFileId;
        $this->bigFileId = $bigFileId;
    }

    public function getSmallFileId(): string
    {
        return $this->smallFileId;
    }

    public function getBigFileId(): string
    {
        return $this->bigFileId;
    }
}
