<?php

declare(strict_types=1);

namespace App\Services\Auction;

use Carbon\CarbonImmutable;

final class Auction
{
    public function __construct(
        private int $orderId,
        private CarbonImmutable $startDate,
        private int $amount,
        private string $currentPrice
    )
    {}

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getStartDate(): CarbonImmutable
    {
        return $this->startDate;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrentPrice(): string
    {
        return $this->currentPrice;
    }
}
