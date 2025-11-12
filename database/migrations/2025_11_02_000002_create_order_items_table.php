<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('restrict');
            $table->text('product_name')->nullable();
            $table->json('measurement')->nullable();
            $table->boolean('is_from_inventory')->default(true);
            $table->decimal('sell_price', 10, 2);
            $table->decimal('quantity_meters', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'progress', 'completed'])->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
