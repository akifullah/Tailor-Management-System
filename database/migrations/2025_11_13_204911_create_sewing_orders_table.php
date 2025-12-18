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
        Schema::create('sewing_orders', function (Blueprint $table) {
            $table->id();
            $table->string('sewing_order_number')->nullable();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->date('order_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('remaining_amount', 10, 2)->default(0);
            $table->enum('payment_method', ['cash', 'online', 'bank_transfer', 'cheque'])->default('cash');
            $table->decimal('partial_amount', 10, 2)->nullable();
            $table->enum('payment_status', ['partial', 'full', "no_payment"])->default('partial');
            $table->enum('order_status', ['pending', 'in_progress', 'completed', "cancelled", "delivered"])->default('pending');
            $table->text('notes')->nullable();
            $table->date('delivered_date')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->foreignId('cancelled_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('cancellation_reason')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewing_orders');
    }
};
