<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sewing_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sewing_order_id')->constrained('sewing_orders')->onDelete('cascade');
            $table->string('product_name');
            $table->decimal('sewing_price', 10, 2);
            $table->integer('qty');
            $table->text('customer_measurement')->nullable(); // JSON or text
            $table->foreignId('assign_to')->nullable()->constrained('users')->onDelete('set null');
            $table->text('assign_note')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->decimal('total_price', 10, 2)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewing_order_items');
    }
};
