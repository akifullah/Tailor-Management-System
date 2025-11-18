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
            // $table->foreignId('assign_to')->nullable()->constrained('users')->onDelete('restrict');
            // $table->foreignId('assign_notes')->nullable();
            $table->text('product_name')->nullable();
            // $table->json('measurement')->nullable();
            $table->boolean('is_from_inventory')->default(true);
            $table->decimal('sell_price', 10, 2);
            $table->decimal('quantity_meters', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->boolean("is_return")->default(false);
            $table->date("return_date")->nullable();
            $table->text("return_reason")->nullable();
            $table->enum('status', ['pending', 'progress', 'completed'])->default('pending');
            // $table->enum('status', ['pending', 'in_progress', 'completed', 'on_hold', 'cancelled', 'delivered'])->default('pending')->after('total_price');
            // $table->timestamp('cancelled_at')->nullable()->after('status');
            // $table->foreignId('cancelled_by')->nullable()->constrained('users')->onDelete('set null')->after('cancelled_at');
            // $table->text('cancellation_reason')->nullable()->after('cancelled_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
