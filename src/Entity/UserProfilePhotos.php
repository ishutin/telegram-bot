<?php

namespace Telegram\Entity;

class UserProfilePhotos
{
    /**
     * @var int
     */
    private $totalCount;

    /**
     * @var PhotoSize[]
     */
    private $photos;

    /**
     * UserProfilePhotos constructor.
     * @param int $totalCount
     * @param PhotoSize[] $photos
     */
    public function __construct(int $totalCount, array $photos)
    {
        $this->totalCount = $totalCount;
        $this->photos = $photos;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * @return PhotoSize[]
     */
    public function getPhotos(): array
    {
        return $this->photos;
    }
}
