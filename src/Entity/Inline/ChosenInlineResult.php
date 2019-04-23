<?php

namespace Telegram\Entity\Inline;

use Telegram\Entity\Location;
use Telegram\Entity\User;

class ChosenInlineResult
{
    /**
     * @var string
     */
    private $resultId;

    /**
     * @var User
     */
    private $from;

    /**
     * @var string
     */
    private $query;

    /**
     * @var Location|null
     */
    private $location;

    /**
     * @var string|null
     */
    private $inlineMessageId;

    public function __construct(string $resultId, User $from, string $query)
    {
        $this->resultId = $resultId;
        $this->from = $from;
        $this->query = $query;
    }

    public function getResultId(): string
    {
        return $this->resultId;
    }

    public function getFrom(): User
    {
        return $this->from;
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): void
    {
        $this->location = $location;
    }

    public function getInlineMessageId(): ?string
    {
        return $this->inlineMessageId;
    }

    public function setInlineMessageId(?string $inlineMessageId): void
    {
        $this->inlineMessageId = $inlineMessageId;
    }
}
