<?php

namespace Telegram\Entity\Passport;

class EncryptedCredentials
{
    /**
     * @var string
     */
    private $data;

    /**
     * @var string
     */
    private $hash;

    /**
     * @var string
     */
    private $secret;

    public function __construct(string $data, string $hash, string $secret)
    {
        $this->data = $data;
        $this->hash = $hash;
        $this->secret = $secret;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }
}
