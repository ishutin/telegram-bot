<?php

namespace Telegram\Entity\Passport;

class PassportData
{
    /**
     * @var EncryptedPassportElement[]
     */
    private $data;

    /**
     * @var EncryptedCredentials
     */
    private $credentials;

    /**
     * PassportData constructor.
     * @param EncryptedPassportElement[] $data
     * @param EncryptedCredentials $credentials
     */
    public function __construct(array $data, EncryptedCredentials $credentials)
    {
        $this->data = $data;
        $this->credentials = $credentials;
    }

    /**
     * @return EncryptedPassportElement[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return EncryptedCredentials
     */
    public function getCredentials(): EncryptedCredentials
    {
        return $this->credentials;
    }
}
