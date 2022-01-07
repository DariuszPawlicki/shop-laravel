<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Order;
use App\Services\Auction\Auction;
use App\Services\Auction\Contracts\AuctionRepository;
use App\Services\Order\Contracts\OrderRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreAuctionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => 'required',
            'start_date' => 'required|date|date_format:Y-m-d',
            'amount' => 'required|integer|not_bigger_than_available_amount',
            'current_price' => 'required|numeric',
        ];
    }

    protected function getValidatorInstance(): Validator
    {
        /** @var Validator $validator */
        $validator = parent::getValidatorInstance();

        $validator->addImplicitExtension(
            'not_bigger_than_available_amount',
            function ($attribute, $value): bool {
                $orderId = (int) $this->post('order_id');

                /** @var OrderRepository $orderRepository */
                $orderRepository = app(OrderRepository::class);
                $order = $orderRepository->find($orderId);
                $maxAmount = $order->getAmount();

                /** @var AuctionRepository $auctionRepository */
                $auctionRepository = app(AuctionRepository::class);
                $auctions = $auctionRepository->findForOrder($orderId);
                $auctionsProductsAmount = $auctions->sum(fn(Auction $auction): int => $auction->getAmount());

                return $auctionsProductsAmount + $value <= $maxAmount;
            }
        );

        return $validator;
    }
}
