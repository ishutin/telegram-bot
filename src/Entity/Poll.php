<?php

namespace Telegram\Entity;

class Poll
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $question;

    /**
     * @var PollOption[]
     */
    private $options = [];

    /**
     * @var bool
     */
    private $isClosed;

    public function __construct(string $id, string $question, array $options, bool $isClosed)
    {
        $this->id = $id;
        $this->question = $question;
        $this->options = $options;
        $this->isClosed = $isClosed;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @return PollOption[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return bool
     */
    public function isClosed(): bool
    {
        return $this->isClosed;
    }


}
