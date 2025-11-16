<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->morphs('payable'); // payable_type, payable_id (for Order or InventoryTracking)
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['cash', 'online', 'bank_transfer', 'cheque'])->default('cash');
            $table->string('person_reference')->nullable(); // e.g., "John Doe - INV-123"
            $table->dateTime('payment_date');
            $table->text('notes')->nullable();
            $table->enum('type', ['payment', 'refund'])->default('payment');
            $table->foreignId('refund_for_payment_id')->nullable()->constrained('payments')->onDelete('set null');
            $table->text('refund_reason')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
