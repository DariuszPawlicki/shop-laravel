<?php

declare(strict_types=1);

namespace App\Services\Order\Contracts;

use App\Services\Order\Order;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

interface OrderRepository
{
    public function store(
        string $series,
        string $name,
        string $number,
        int $amount,
        string $orderPrice,
        string $listPrice,
        string $estimatedPrice,
        string $shop,
        CarbonImmutable $orderDate,
        ?CarbonImmutable $deliveryDate
    ): void;

    /**
     * @return Collection|Order[]
     */
    public function getAll(): Collection;

    public function update(
        int $orderId,
        string $series,
        string $name,
        string $number,
        int $amount,
        string $orderPrice,
        string $listPrice,
        string $estimatedPrice,
        string $shop,
        CarbonImmutable $orderDate,
        ?CarbonImmutable $deliveryDate
    ): void;

    public function delete(int $orderId): void;

    public function find(int $orderId): Order;
}
