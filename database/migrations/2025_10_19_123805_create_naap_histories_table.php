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
        Schema::create('naap_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('naap_id')->constrained()->onDelete('restrict');
            $table->json('data'); // store full measurement snapshot as JSON
            $table->unsignedInteger('version');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naap_histories');
    }
};
