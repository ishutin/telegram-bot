<?php

namespace Telegram\Entity;

class PollOption
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var int
     */
    private $voterCount;

    public function __construct(string $text, int $voterCount)
    {
        $this->text = $text;
        $this->voterCount = $voterCount;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getVoterCount(): int
    {
        return $this->voterCount;
    }
}
