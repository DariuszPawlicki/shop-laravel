<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'series' => $this->faker->word(),
            'name' => $this->faker->word(),
            'number' => $this->faker->numerify(),
            'amount' => $this->faker->numberBetween(1, 10),
            'order_price' => $this->faker->randomFloat(2, 1, 500),
            'list_price' => $this->faker->randomFloat(2, 1, 500),
            'estimated_price' => $this->faker->randomFloat(2, 1, 500),
            'shop' => $this->faker->word(),
            'order_date' => $this->faker->date(),
            'delivery_date' => $this->faker->date(),
        ];
    }
}
