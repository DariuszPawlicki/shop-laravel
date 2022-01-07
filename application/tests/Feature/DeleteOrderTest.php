<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use App\Models\Order as OrderModel;

class DeleteOrderTest extends TestCase
{
    use RefreshDatabase;

    private const URL_FORMAT = '/api/orders/%s';
    private const TABLE = 'orders';

    public function testShouldDeleteTest(): void
    {
        /** @var OrderModel $orderModel */
        $orderModel = OrderModel::factory()->create();

        $response = $this->json(
            Request::METHOD_DELETE,
            sprintf(self::URL_FORMAT, $orderModel->id)
        );

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseMissing(self::TABLE, [
            'id' => $orderModel->id,
        ]);
    }
}
