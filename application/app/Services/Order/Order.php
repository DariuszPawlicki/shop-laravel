<?php

declare(strict_types=1);

namespace App\Services\Order;

use Carbon\CarbonImmutable;

final class Order
{
    public function __construct(
        private int $id,
        private string $series,
        private string $name,
        private string $number,
        private int $amount,
        private string $orderPrice,
        private string $listPrice,
        private string $estimatedPrice,
        private string $shop,
        private CarbonImmutable $orderDate,
        private ?CarbonImmutable $deliveryDate
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSeries(): string
    {
        return $this->series;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getOrderPrice(): string
    {
        return $this->orderPrice;
    }

    public function getListPrice(): string
    {
        return $this->listPrice;
    }

    public function getShop(): string
    {
        return $this->shop;
    }

    public function getOrderDate(): CarbonImmutable
    {
        return $this->orderDate;
    }

    public function getDeliveryDate(): ?CarbonImmutable
    {
        return $this->deliveryDate;
    }

    public function getEstimatedPrice(): string
    {
        return $this->estimatedPrice;
    }
}
