<?php

namespace Telegram\Entity;

class Venue
{
    /**
     * @var Location
     */
    private $location;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string|null
     */
    private $foursquareId;

    /**
     * @var string|null
     */
    private $foursquareType;

    public function __construct(Location $location, string $title, string $address)
    {
        $this->location = $location;
        $this->title = $title;
        $this->address = $address;
    }

    /**
     * @return Location
     */
    public function getLocation(): Location
    {
        return $this->location;
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
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getFoursquareId(): ?string
    {
        return $this->foursquareId;
    }

    /**
     * @param string|null $foursquareId
     */
    public function setFoursquareId(?string $foursquareId): void
    {
        $this->foursquareId = $foursquareId;
    }

    /**
     * @return string|null
     */
    public function getFoursquareType(): ?string
    {
        return $this->foursquareType;
    }

    /**
     * @param string|null $foursquareType
     */
    public function setFoursquareType(?string $foursquareType): void
    {
        $this->foursquareType = $foursquareType;
    }
}
