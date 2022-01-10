<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table): void {
            $table->id();
            $table->bigInteger('user_id')->unsigned();  
            $table->text('series');
            $table->text('name');
            $table->text('number');
            $table->unsignedSmallInteger('amount');
            $table->decimal('order_price', 8, 2, true);
            $table->decimal('list_price', 8, 2, true);
            $table->decimal('estimated_price', 8, 2, true);
            $table->text('shop');
            $table->date('order_date');
            $table->date('delivery_date')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
