<?php

namespace Telegram\Entity\Payment;

class SuccessfulPayment
{
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
     * @var string
     */
    private $telegramPaymentChargeId;

    /**
     * @var string
     */
    private $providerPaymentChargeId;

    /**
     * @var string|null
     */
    private $shippingOptionId;

    /**
     * @var OrderInfo|null
     */
    private $orderInfo;

    public function __construct(
        string $currency,
        int $totalAmount,
        string $invoicePayload,
        string $telegramPaymentChargeId,
        string $providerPaymentChargeId
    ) {
        $this->currency = $currency;
        $this->totalAmount = $totalAmount;
        $this->invoicePayload = $invoicePayload;
        $this->telegramPaymentChargeId = $telegramPaymentChargeId;
        $this->providerPaymentChargeId = $providerPaymentChargeId;
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
     * @return string
     */
    public function getTelegramPaymentChargeId(): string
    {
        return $this->telegramPaymentChargeId;
    }

    /**
     * @return string
     */
    public function getProviderPaymentChargeId(): string
    {
        return $this->providerPaymentChargeId;
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
