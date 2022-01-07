<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        Date::use(CarbonImmutable::class);
    }

    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}
