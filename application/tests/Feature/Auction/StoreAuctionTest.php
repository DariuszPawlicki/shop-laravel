<?php

declare(strict_types=1);

namespace Tests\Feature\Auction;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use App\Models\Order as OrderModel;
use App\Models\Auction as AuctionModel;

class StoreAuctionTest extends TestCase
{
    use RefreshDatabase;

    private const URL = '/api/auctions';
    private const START_DATE = '2021-03-14';
    private const START_DATE_DATABASE = '2021-03-14 00:00:00';
    private const AMOUNT = 1;
    private const CURRENT_PRICE = '1.23';
    private const TABLE = 'auctions';

    public function testShouldStoreAuction(): void
    {
        /** @var OrderModel $order */
        $order = OrderModel::factory()->create();

        $response = $this->json(
            Request::METHOD_POST,
            self::URL,
            [
                'order_id' => $order->id,
                'start_date' => self::START_DATE,
                'amount' => self::AMOUNT,
                'current_price' => self::CURRENT_PRICE,
            ]
        );

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas(self::TABLE, [
            'order_id' => $order->id,
            'start_date' => self::START_DATE_DATABASE,
            'amount' => self::AMOUNT,
            'current_price' => self::CURRENT_PRICE,
        ]);
    }

    public function testShouldNotStoreWhenAmountGreaterThanAvailableAmount(): void
    {
        /** @var AuctionModel $auctionModel */
        $auctionModel = AuctionModel::factory()->create();
        /** @var OrderModel $order */
        $order = $auctionModel->order;

        $soldAmount = $order->amount + 1;

        $response = $this->json(
            Request::METHOD_POST,
            self::URL,
            [
                'order_id' => $order->id,
                'start_date' => self::START_DATE,
                'amount' => $soldAmount,
                'current_price' => self::CURRENT_PRICE,
            ]
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertDatabaseMissing(self::TABLE, [
            'order_id' => $order->id,
            'start_date' => self::START_DATE,
            'amount' => $soldAmount,
            'current_price' => self::CURRENT_PRICE,
        ]);
    }
}
