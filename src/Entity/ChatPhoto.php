<?php

namespace Telegram\Entity;

/**
 * Class ChatPhoto
 * @package Telegram\Entity
 *
 * @property string $smallFileId
 * @property string $bigFileId
 */
class ChatPhoto extends Entity
{
    /**
     * @var string
     */
    private $smallFileId;

    /**
     * @var string
     */
    private $bigFileId;

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
