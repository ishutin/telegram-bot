<?php

namespace Telegram\Entity\Game;

use Telegram\Entity\Animation;
use Telegram\Entity\MessageEntity;
use Telegram\Entity\PhotoSize;

class Game
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var PhotoSize[]
     */
    private $photo;

    /**
     * @var string|null
     */
    private $text;

    /**
     * @var MessageEntity[]
     */
    private $textEntities = [];

    /**
     * @var Animation|null
     */
    private $animation;

    /**
     * Game constructor.
     * @param string $title
     * @param string $description
     * @param PhotoSize[] $photo
     */
    public function __construct(string $title, string $description, array $photo)
    {
        $this->title = $title;
        $this->description = $description;
        $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return PhotoSize[]
     */
    public function getPhoto(): array
    {
        return $this->photo;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     */
    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return MessageEntity[]
     */
    public function getTextEntities(): array
    {
        return $this->textEntities;
    }

    /**
     * @param MessageEntity[] $textEntities
     */
    public function setTextEntities(array $textEntities): void
    {
        $this->textEntities = $textEntities;
    }

    /**
     * @return Animation|null
     */
    public function getAnimation(): ?Animation
    {
        return $this->animation;
    }

    /**
     * @param Animation|null $animation
     */
    public function setAnimation(?Animation $animation): void
    {
        $this->animation = $animation;
    }
}
