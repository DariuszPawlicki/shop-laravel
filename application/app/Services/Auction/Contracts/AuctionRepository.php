<?php

namespace App\Services\Auction\Contracts;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

interface AuctionRepository
{
    public function findForOrder(int $orderId): Collection;

    public function store(int $orderId, CarbonImmutable $startDate, int $amount, string $currentPrice): void;
}
