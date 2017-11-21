<?php

namespace Telegram\Entity;

/**
 * Class User
 * @package Telegram\Entity
 *
 * @property int $id
 * @property string $firstName
 * @property string $lastName
 * @property string $username
 * @property string $lang
 * @property bool $isBot
 */
class User extends Entity
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
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $lang;

    /**
     * @var bool
     */
    private $isBot;

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
