<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Auction;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuctionFactory extends Factory
{
    protected $model = Auction::class;

    public function definition()
    {
        /** @var Order $order */
        $order = Order::factory()->create();
        return [
            'order_id' => $order->id,
            'start_date' => $this->faker->date(),
            'amount' => $this->faker->numberBetween(1, $order->amount),
            'current_price' => $this->faker->randomFloat(2, 1, 500),
        ];
    }
}
