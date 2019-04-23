<?php

namespace Telegram\Entity;

class User
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $lang;

    /**
     * @var bool
     */
    protected $isBot;

    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $username,
        string $lang,
        bool $isBot

    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->lang = $lang;
        $this->isBot = $isBot;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function getIsBot(): bool
    {
        return $this->isBot;
    }
}
