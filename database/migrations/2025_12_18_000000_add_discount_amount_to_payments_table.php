<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // NOTE: This migration was generated during a local change but the project
    // design stores discounts on `sewing_orders.discount_amount` instead of
    // per-payment. Leaving this migration as a no-op to avoid accidental
    // schema changes. You can safely delete this file if desired.
    public function up(): void
    {
        // intentionally left blank
    }

    public function down(): void
    {
        // intentionally left blank
    }
};
