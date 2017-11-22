<?php

namespace Telegram\Entity;

/**
 * Class Photo
 * @package Telegram\Entity
 *
 * @property string $id
 * @property int $width
 * @property int $height
 * @mixin FileSizeEntityTrait
 */
class Photo extends Entity
{
    use FileSizeEntityTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    public function __construct(
        string $id,
        int $width,
        int $height
    ) {
        $this->id = $id;
        $this->width = $width;
        $this->height = $height;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}
