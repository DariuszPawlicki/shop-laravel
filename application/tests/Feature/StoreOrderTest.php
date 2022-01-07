<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreOrderTest extends TestCase
{
    use RefreshDatabase;

    private const URL = '/api/orders';
    private const TABLE = 'orders';
    private const SERIES = 'series';
    private const NAME = 'name';
    private const NUMBER = 'number';
    private const AMOUNT = 10;
    private const ORDER_PRICE = '10.21';
    private const LIST_PRICE = '11.1';
    private const ESTIMATED_PRICE = '12.1';
    private const SHOP = 'shop';
    private const ORDER_DATE = '2021-03-24';
    private const DELIVERY_DATE = '2021-03-30';
    private const ORDER_DATE_DATABASE = '2021-03-24 00:00:00';
    private const DELIVERY_DATE_DATABASE = '2021-03-30 00:00:00';


    public function testGuestMayStoreOrderWithDeliveryDateDifferentThanNull(): void
    {
        $response = $this->json(
            Request::METHOD_POST,
            self::URL,
            [
                'series' => self::SERIES,
                'name' => self::NAME,
                'number' => self::NUMBER,
                'amount' => self::AMOUNT,
                'order_price' => self::ORDER_PRICE,
                'list_price' => self::LIST_PRICE,
                'estimated_price' => self::ESTIMATED_PRICE,
                'shop' => self::SHOP,
                'order_date' => self::ORDER_DATE,
                'delivery_date' => self::DELIVERY_DATE,
            ],
        );

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas(self::TABLE, [
            'series' => self::SERIES,
            'name' => self::NAME,
            'number' => self::NUMBER,
            'amount' => self::AMOUNT,
            'order_price' => self::ORDER_PRICE,
            'list_price' => self::LIST_PRICE,
            'estimated_price' => self::ESTIMATED_PRICE,
            'shop' => self::SHOP,
            'order_date' => self::ORDER_DATE_DATABASE,
            'delivery_date' => self::DELIVERY_DATE_DATABASE,
        ]);
    }
}
