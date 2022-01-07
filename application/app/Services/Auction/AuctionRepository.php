<?php

declare(strict_types=1);

namespace App\Services\Auction;

use App\Services\Auction\Contracts\AuctionRepository as AuctionRepositoryContract;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use App\Models\Auction as AuctionModel;

final class AuctionRepository implements AuctionRepositoryContract
{
    public function findForOrder(int $orderId): Collection
    {
        return AuctionModel::whereOrderId($orderId)->get()->map(fn(AuctionModel $auction): Auction =>
            $this->mapToAuction($auction)
        );
    }

    public function store(int $orderId, CarbonImmutable $startDate, int $amount, string $currentPrice): void
    {
        $auctionModel = new AuctionModel();
        $auctionModel->order_id = $orderId;
        $auctionModel->start_date = $startDate;
        $auctionModel->amount = $amount;
        $auctionModel->current_price = $currentPrice;
        $auctionModel->saveOrFail();
    }

    private function mapToAuction(AuctionModel $auctionModel): Auction
    {
        return new Auction(
            $auctionModel->order_id,
            $auctionModel->start_date,
            $auctionModel->amount,
            $auctionModel->current_price
        );
    }
}
