<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Order\OrderRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use App\Services\Order\Contracts\OrderRepository as OrderRepositoryContract;

class OrderRepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->bind(OrderRepositoryContract::class, OrderRepository::class);
    }

    public function provides()
    {
        return [OrderRepositoryContract::class];
    }
}
