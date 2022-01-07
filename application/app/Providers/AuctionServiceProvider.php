<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Auction\AuctionRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use App\Services\Auction\Contracts\AuctionRepository as AuctionRepositoryContract;

class AuctionServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->bind(AuctionRepositoryContract::class, AuctionRepository::class);
    }

    public function provides()
    {
        return [AuctionRepositoryContract::class];
    }
}
