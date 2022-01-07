<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('auctions', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->date('start_date');
            $table->unsignedSmallInteger('amount');
            $table->decimal('current_price', 8, 2, true);
            $table->timestamps();
            $table->foreign('order_id')
                ->references('id')
                ->on('orders');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
}
