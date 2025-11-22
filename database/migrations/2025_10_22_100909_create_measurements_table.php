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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();


            $table->foreignId('customer_id')->constrained()->onDelete('restrict');
            $table->string('type'); // pant, shirt, etc.
            $table->json('data')->nullable(); // all measurement fields stored as JSON
            $table->json('style')->nullable(); // all style fields stored as JSON
            $table->text('notes')->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
