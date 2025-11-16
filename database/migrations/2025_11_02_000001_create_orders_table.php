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
            $table->enum('payment_method', ['online', 'cash', "bank_transfer", "cheque"])->default('cash')->nullable();
            $table->enum('payment_status', ['partial', 'full', "no_payment"])->default('full');
            $table->decimal('partial_amount', 10, 2)->nullable();
            $table->decimal('remaining_amount', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->boolean("is_return")->default(false);
            $table->date("return_date")->nullable();
            $table->text("return_reason")->nullable();
            $table->enum('order_status', ['pending', 'in_progress', 'completed', 'on_hold', 'cancelled', 'delivered'])
            // $table->enum('order_status', ['pending', 'in_progress', 'completed', 'on_hold', 'cancelled', 'delivered'])->default('pending')->after('payment_status');
            // $table->timestamp('cancelled_at')->nullable()->after('order_status');
            // $table->foreignId('cancelled_by')->nullable()->constrained('users')->onDelete('set null')->after('cancelled_at');
            // $table->text('cancellation_reason')->nullable()->after('cancelled_by');
            ->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
