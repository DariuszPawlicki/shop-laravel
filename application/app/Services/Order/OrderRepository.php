<?php

declare(strict_types=1);

namespace App\Services\Order;

use App\Services\Order\Contracts\OrderRepository as OrderRepositoryContract;
use Carbon\CarbonImmutable;
use App\Models\Order as OrderModel;
use Illuminate\Support\Collection;

final class OrderRepository implements OrderRepositoryContract
{
    public function store(
        string $series,
        int $userId,
        string $name,
        string $number,
        int $amount,
        string $orderPrice,
        string $listPrice,
        string $estimatedPrice,
        string $shop,
        CarbonImmutable $orderDate,
        ?CarbonImmutable $deliveryDate
    ): void {
        $orderModel = new OrderModel();
        $orderModel->series = $series;
        $orderModel->user_id = $userId;
        $orderModel->name = $name;
        $orderModel->number = $number;
        $orderModel->amount = $amount;
        $orderModel->order_price = $orderPrice;
        $orderModel->list_price = $listPrice;
        $orderModel->estimated_price = $estimatedPrice;
        $orderModel->shop = $shop;
        $orderModel->order_date = $orderDate;
        $orderModel->delivery_date = $deliveryDate;
        $orderModel->saveOrFail();
    }

    public function getAll(): Collection
    {
        return OrderModel::orderByDesc('created_at')
            ->where('user_id', '=', auth()->id())
            ->get()
            ->map(fn(OrderModel $orderModel): Order => $this->mapToOrder($orderModel));
    }

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
    ): void {
        OrderModel::whereId($orderId)->update([
            'series' => $series,
            'name' => $name,
            'number' => $number,
            'amount' => $amount,
            'order_price' => $orderPrice,
            'list_price' => $listPrice,
            'estimated_price' => $estimatedPrice,
            'shop' => $shop,
            'order_date' => $orderDate,
            'delivery_date' => $deliveryDate,
        ]);
    }

    public function delete(int $orderId): void
    {
        OrderModel::destroy($orderId);
    }

    public function find(int $orderId): Order
    {
        return $this->mapToOrder(OrderModel::whereId($orderId)->firstOrFail());
    }

    private function mapToOrder(OrderModel $orderModel): Order
    {
        return new Order(
            $orderModel->id,
            $orderModel->user_id,
            $orderModel->series,
            $orderModel->name,
            $orderModel->number,
            $orderModel->amount,
            $orderModel->order_price,
            $orderModel->list_price,
            $orderModel->estimated_price,
            $orderModel->shop,
            $orderModel->order_date,
            $orderModel->delivery_date
        );
    }
}
