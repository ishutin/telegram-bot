<?php

namespace Telegram\Entity\Passport;

class EncryptedPassportElement
{
    public const TYPE_PERSONAL_DETAILS = 'personal_details';
    public const TYPE_PASSPORT = 'passport';
    public const TYPE_DRIVER_LICENSE = 'driver_license';
    public const TYPE_IDENTITY_CARD = 'identity_card';
    public const TYPE_INTERNAL_PASSPORT = 'internal_passport';
    public const TYPE_ADDRESS = 'address';
    public const TYPE_UTILITY_BILL = 'utility_bill';
    public const TYPE_BANK_STATEMENT = 'bank_statement';
    public const TYPE_RENTAL_AGREEMENT = 'rental_agreement';
    public const TYPE_PASSPORT_REGISTRATION = 'passport_registration';
    public const TYPE_TEMPORARY_REGISTRATION = 'temporary_registration';
    public const TYPE_PHONE_NUMBER = 'phone_number';
    public const TYPE_EMAIL = 'email';

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $hash;

    /**
     * @var string|null
     */
    private $data;

    /**
     * @var string|null
     */
    private $phoneNumber;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var PassportFile[]
     */
    private $files = [];

    /**
     * @var PassportFile
     */
    private $frontSide;

    /**
     * @var PassportFile
     */
    private $reverseSide;

    /**
     * @var PassportFile
     */
    private $selfie;

    /**
     * @var PassportFile[]
     */
    private $translation = [];

    public function __construct(string $type, string $hash)
    {
        $this->type = $type;
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     */
    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return PassportFile[]
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @param PassportFile[] $files
     */
    public function setFiles(array $files): void
    {
        $this->files = $files;
    }

    /**
     * @return PassportFile
     */
    public function getFrontSide(): PassportFile
    {
        return $this->frontSide;
    }

    /**
     * @param PassportFile $frontSide
     */
    public function setFrontSide(PassportFile $frontSide): void
    {
        $this->frontSide = $frontSide;
    }

    /**
     * @return PassportFile
     */
    public function getReverseSide(): PassportFile
    {
        return $this->reverseSide;
    }

    /**
     * @param PassportFile $reverseSide
     */
    public function setReverseSide(PassportFile $reverseSide): void
    {
        $this->reverseSide = $reverseSide;
    }

    /**
     * @return PassportFile
     */
    public function getSelfie(): PassportFile
    {
        return $this->selfie;
    }

    /**
     * @param PassportFile $selfie
     */
    public function setSelfie(PassportFile $selfie): void
    {
        $this->selfie = $selfie;
    }

    /**
     * @return PassportFile[]
     */
    public function getTranslation(): array
    {
        return $this->translation;
    }

    /**
     * @param PassportFile[] $translation
     */
    public function setTranslation(array $translation): void
    {
        $this->translation = $translation;
    }

    /**
     * @return string|null
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * @param string|null $data
     */
    public function setData(?string $data): void
    {
        $this->data = $data;
    }
}
