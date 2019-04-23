<?php

namespace Telegram\Entity\Payment;

use Telegram\Entity\User;

class ShippingQuery
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var User
     */
    private $from;

    /**
     * @var string
     */
    private $invoicePayload;

    /**
     * @var ShippingAddress
     */
    private $shippingAddress;

    public function __construct(string $id, User $from, string $invoicePayload, ShippingAddress $shippingAddress)
    {
        $this->id = $id;
        $this->from = $from;
        $this->invoicePayload = $invoicePayload;
        $this->shippingAddress = $shippingAddress;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getFrom(): User
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getInvoicePayload(): string
    {
        return $this->invoicePayload;
    }

    /**
     * @return ShippingAddress
     */
    public function getShippingAddress(): ShippingAddress
    {
        return $this->shippingAddress;
    }
}
