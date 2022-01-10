<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\Order\Contracts\OrderRepository;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Auth;


class OrderController extends Controller
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->middleware('auth');
        $this->orderRepository = $orderRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return OrderResource::collection($this->orderRepository->getAll());
    }

    public function store(StoreOrderRequest $request): Response
    {
        $deliveryDate = $request->has('delivery_date')
            ? new CarbonImmutable($request->post('delivery_date'))
            : null;
        
        $this->orderRepository->store(
            $request->post('series'),
            auth()->id(),
            $request->post('name'),
            $request->post('number'),
            (int) $request->post('amount'),
            $request->post('order_price'),
            $request->post('list_price'),
            $request->post('estimated_price'),
            $request->post('shop'),
            new CarbonImmutable($request->post('order_date')),
            $deliveryDate,
        );

        return new Response('', Response::HTTP_CREATED);
    }

    public function update(UpdateOrderRequest $request, int $orderId): Response
    {
        $deliveryDate = $request->has('delivery_date')
            ? new CarbonImmutable($request->post('delivery_date'))
            : null;

        $this->orderRepository->update(
            $orderId,
            $request->post('series'),
            $request->post('name'),
            $request->post('number'),
            (int) $request->post('amount'),
            $request->post('order_price'),
            $request->post('list_price'),
            $request->post('estimated_price'),
            $request->post('shop'),
            new CarbonImmutable($request->post('order_date')),
            $deliveryDate
        );

        return new Response();
    }

    public function destroy(int $orderId): Response
    {
        $this->orderRepository->delete($orderId);

        return new Response();
    }
}
