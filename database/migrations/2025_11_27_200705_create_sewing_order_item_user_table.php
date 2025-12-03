<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sewing_order_item_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sewing_order_item_id')->constrained('sewing_order_items')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', "on_hold", 'in_progress', "cutter", "sewing", 'completed'])->default('pending');
            $table->timestamps();
        });

        // Migrate existing data
        $items = DB::table('sewing_order_items')->whereNotNull('assign_to')->get();
        foreach ($items as $item) {
            DB::table('sewing_order_item_user')->insert([
                'sewing_order_item_id' => $item->id,
                'user_id' => $item->assign_to,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::table('sewing_order_items', function (Blueprint $table) {
            $table->dropForeign(['assign_to']);
            $table->dropColumn('assign_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sewing_order_items', function (Blueprint $table) {
            $table->foreignId('assign_to')->nullable()->constrained('users')->onDelete('restrict');
        });

        // Restore data (pick the first assigned user if multiple)
        $assignments = DB::table('sewing_order_item_user')->get();
        foreach ($assignments as $assignment) {
            // Only update if assign_to is null to avoid overwriting with subsequent assignments
            // This is a lossy reverse migration if multiple workers were assigned
            DB::table('sewing_order_items')
                ->where('id', $assignment->sewing_order_item_id)
                ->whereNull('assign_to')
                ->update(['assign_to' => $assignment->user_id]);
        }

        Schema::dropIfExists('sewing_order_item_user');
    }
};
