<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('customer_id')->constrained()->onDelete('restrict');
            $table->date('order_date');
            // $table->date('delivery_date')->nullable();
            // $table->enum('delivery_status', ['pending', 'delivered'])->default('pending');
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_method', ['online', 'cash'])->default('cash');
            $table->enum('payment_status', ['partial', 'full'])->default('full');
            $table->decimal('partial_amount', 10, 2)->nullable();
            $table->decimal('remaining_amount', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

