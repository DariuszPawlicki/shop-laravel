<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Services\Order\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Order $order */
        $order = $this->resource;

        return [
            'id' => $order->getId(),
            'user_id' => $order->getUserId(),
            'series' => $order->getSeries(),
            'name' => $order->getName(),
            'number' => $order->getNumber(),
            'amount' => $order->getAmount(),
            'order_price' => $order->getOrderPrice(),
            'list_price' => $order->getListPrice(),
            'estimated_price' => $order->getEstimatedPrice(),
            'shop' => $order->getShop(),
            'order_date' => $order->getOrderDate()->toDateString(),
            'delivery_date' => $order?->getDeliveryDate()?->toDateString(),
        ];
    }
}
