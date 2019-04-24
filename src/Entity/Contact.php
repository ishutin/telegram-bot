<?php

namespace Telegram\Entity;

class Contact
{
    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string|null
     */
    private $lastName;

    /**
     * @var int|null
     */
    private $userId;

    /**
     * @var string|null
     */
    private $vCard;

    public function __construct(string $phoneNumber, string $firstName)
    {
        $this->phoneNumber = $phoneNumber;
        $this->firstName = $firstName;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     */
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string|null
     */
    public function getVCard(): ?string
    {
        return $this->vCard;
    }

    /**
     * @param string|null $vCard
     */
    public function setVCard(?string $vCard): void
    {
        $this->vCard = $vCard;
    }
}
