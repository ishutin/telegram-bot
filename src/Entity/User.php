<?php

namespace Telegram\Entity;

class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string|null
     */
    private $lastName;

    /**
     * @var string|null
     */
    private $username;

    /**
     * @var string|null
     */
    private $languageCode;

    /**
     * @var bool
     */
    private $isBot;

    public function __construct(
        int $id,
        string $firstName,
        bool $isBot

    ) {
        $this->id = $id;
        $this->firstName = $firstName;
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

    public function getLanguageCode(): string
    {
        return $this->languageCode;
    }

    public function getIsBot(): bool
    {
        return $this->isBot;
    }

    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param string|null $languageCode
     */
    public function setLanguageCode(?string $languageCode): void
    {
        $this->languageCode = $languageCode;
    }
}
