<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('restrict');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('restrict');
            $table->foreignId('supplier_id')->nullable()->constrained()->onDelete('restrict');
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('sell_price', 10, 2);
            $table->decimal('available_meters', 10, 2)->default(0);
            $table->string('barcode')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
