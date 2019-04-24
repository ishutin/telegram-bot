<?php

namespace Telegram\Entity\Payment;

class Invoice
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $startParameter;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $totalAmount;

    public function __construct(
        string $title,
        string $description,
        string $startParameter,
        string $currency,
        string $totalAmount
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->startParameter = $startParameter;
        $this->currency = $currency;
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getStartParameter(): string
    {
        return $this->startParameter;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getTotalAmount(): string
    {
        return $this->totalAmount;
    }
}
