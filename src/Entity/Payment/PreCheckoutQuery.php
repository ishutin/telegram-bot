<?php

namespace Telegram\Entity\Payment;

use Telegram\Entity\User;

class PreCheckoutQuery
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
    private $currency;

    /**
     * @var int
     */
    private $totalAmount;

    /**
     * @var string
     */
    private $invoicePayload;

    /**
     * @var string|null
     */
    private $shippingOptionId;

    /**
     * @var OrderInfo|null
     */
    private $orderInfo;

    public function __construct(string $id, User $from, string $currency, int $totalAmount, string $invoicePayload)
    {
        $this->id = $id;
        $this->from = $from;
        $this->currency = $currency;
        $this->totalAmount = $totalAmount;
        $this->invoicePayload = $invoicePayload;
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
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }

    /**
     * @return string
     */
    public function getInvoicePayload(): string
    {
        return $this->invoicePayload;
    }

    /**
     * @return string|null
     */
    public function getShippingOptionId(): ?string
    {
        return $this->shippingOptionId;
    }

    /**
     * @param string|null $shippingOptionId
     */
    public function setShippingOptionId(?string $shippingOptionId): void
    {
        $this->shippingOptionId = $shippingOptionId;
    }

    /**
     * @return OrderInfo|null
     */
    public function getOrderInfo(): ?OrderInfo
    {
        return $this->orderInfo;
    }

    /**
     * @param OrderInfo|null $orderInfo
     */
    public function setOrderInfo(?OrderInfo $orderInfo): void
    {
        $this->orderInfo = $orderInfo;
    }
}
