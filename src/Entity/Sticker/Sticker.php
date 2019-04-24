<?php

namespace Telegram\Entity\Sticker;

use Telegram\Entity\Traits\FileSizeTrait;
use Telegram\Entity\Traits\FileThumbTrait;
use Telegram\Entity\Traits\FileTrait;
use Telegram\Entity\Traits\FileWidthAndHeightTrait;

class Sticker
{
    use FileTrait;
    use FileWidthAndHeightTrait;
    use FileThumbTrait;
    use FileSizeTrait;

    /**
     * @var string|null
     */
    private $emoji;

    /**
     * @var string|null
     */
    private $setName;

    /**
     * @var MaskPosition|null
     */
    private $maskPosition;

    public function __construct(string $fileId, int $width, int $height)
    {
        $this->fileId = $fileId;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return string|null
     */
    public function getEmoji(): ?string
    {
        return $this->emoji;
    }

    /**
     * @param string|null $emoji
     */
    public function setEmoji(?string $emoji): void
    {
        $this->emoji = $emoji;
    }

    /**
     * @return string|null
     */
    public function getSetName(): ?string
    {
        return $this->setName;
    }

    /**
     * @param string|null $setName
     */
    public function setSetName(?string $setName): void
    {
        $this->setName = $setName;
    }

    /**
     * @return MaskPosition|null
     */
    public function getMaskPosition(): ?MaskPosition
    {
        return $this->maskPosition;
    }

    /**
     * @param MaskPosition|null $maskPosition
     */
    public function setMaskPosition(?MaskPosition $maskPosition): void
    {
        $this->maskPosition = $maskPosition;
    }
}
