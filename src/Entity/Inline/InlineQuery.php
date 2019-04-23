<?php

namespace Telegram\Entity\Inline;

use Telegram\Entity\Location;
use Telegram\Entity\User;

class InlineQuery
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var User
     */
    private $from;

    /**
     * @var Location|null
     */
    private $location;

    /**
     * @var string
     */
    private $query;

    /**
     * @var string
     */
    private $offset;

    public function __construct(string $id, User $from, string $query, string $offset)
    {
        $this->id = $id;
        $this->from = $from;
        $this->query = $query;
        $this->offset = $offset;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFrom(): User
    {
        return $this->from;
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function getOffset(): string
    {
        return $this->offset;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): void
    {
        $this->location = $location;
    }
}
