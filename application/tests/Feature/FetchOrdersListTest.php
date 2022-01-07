<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Order as OrderModel;
use Symfony\Component\HttpFoundation\Request;

class FetchOrdersListTest extends TestCase
{
    use RefreshDatabase;

    private const URL = '/api/orders';

    public function testGuestMayFetchAllOrders(): void
    {
        /** @var OrderModel $orderModel */
        $orderModel = OrderModel::factory()->create();

        $response = $this->json(Request::METHOD_GET, self::URL);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            [
                'id' => $orderModel->id,
                'series' => $orderModel->series,
                'name' => $orderModel->name,
                'number' => $orderModel->number,
                'amount' => $orderModel->amount,
                'order_price' => $orderModel->order_price,
                'list_price' => $orderModel->list_price,
                'estimated_price' => $orderModel->estimated_price,
                'shop' => $orderModel->shop,
                'order_date' => $orderModel->order_date->toDateString(),
                'delivery_date' => $orderModel->delivery_date->toDateString(),
            ],
        ]);
    }
}
