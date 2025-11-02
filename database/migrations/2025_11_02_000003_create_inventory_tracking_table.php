<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('restrict');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('type', ['purchase', 'sale', 'adjustment', 'return']); // purchase, sale, manual adjustment, return
            $table->decimal('quantity_meters', 10, 2); // positive for add, negative for remove
            $table->decimal('price_per_meter', 10, 2)->nullable(); // for purchase tracking
            $table->decimal('balance_meters', 10, 2); // balance after this transaction
            $table->text('notes')->nullable();
            $table->string('reference_number')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_tracking');
    }
};

