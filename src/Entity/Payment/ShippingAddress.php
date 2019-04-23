<?php

namespace Telegram\Entity\Payment;

class ShippingAddress
{
    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $streetLine1;

    /**
     * @var string
     */
    private $streetLine2;

    /**
     * @var string
     */
    private $postCode;

    public function __construct(
        string $countryCode,
        string $state,
        string $city,
        string $streetLine1,
        string $streetLine2,
        string $postCode
    ) {
        $this->countryCode = $countryCode;
        $this->state = $state;
        $this->city = $city;
        $this->streetLine1 = $streetLine1;
        $this->streetLine2 = $streetLine2;
        $this->postCode = $postCode;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getStreetLine1(): string
    {
        return $this->streetLine1;
    }

    /**
     * @return string
     */
    public function getStreetLine2(): string
    {
        return $this->streetLine2;
    }

    /**
     * @return string
     */
    public function getPostCode(): string
    {
        return $this->postCode;
    }
}
