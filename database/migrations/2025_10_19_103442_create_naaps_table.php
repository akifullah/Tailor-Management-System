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
        Schema::create('naaps', function (Blueprint $table) {
            $table->id();

            $table->foreignId("customer_id")->constrained()->onDelete("restrict");
            $table->string("created_by")->nullable();

            // General
            $table->string('type'); // pant, shirt, kameez, shalwar, coat, waistcoat
            $table->string('fit')->nullable(); // Slim / Regular / Loose

            // Common measurements
            $table->decimal('length', 8, 2)->nullable();
            $table->decimal('chest', 8, 2)->nullable();
            $table->decimal('waist', 8, 2)->nullable();
            $table->decimal('hip', 8, 2)->nullable();
            $table->decimal('shoulder', 8, 2)->nullable();
            $table->decimal('sleeve', 8, 2)->nullable();
            $table->decimal('cuff', 8, 2)->nullable();
            $table->decimal('bottom', 8, 2)->nullable(); // pant/shalwar bottom width

            // Collar & neckline
            $table->string('collar')->nullable(); // Spread / Button-down / Mandarin / etc.
            $table->decimal('neck_depth', 8, 2)->nullable();

            // Buttons / pockets
            $table->unsignedInteger('buttons')->nullable();
            $table->string('pocket_style')->nullable(); // Cross / Straight / Side / Front
            $table->string('pocket_count')->nullable(); // 0 / 1 / 2

            // Style / design details
            $table->string('daman')->nullable(); // Sada / Gool
            $table->string('patae')->nullable(); // Simple / Nokdar
            $table->string('ban')->nullable(); // Full Ban / Half Ban / Kabali
            $table->string('stitching')->nullable(); // Simple / Chamak / etc.
            $table->string('asteen')->nullable(); // One Palet / Two Palet
            $table->string('btn_style')->nullable(); // Simple / Design
            $table->string('chok')->nullable(); // For coat (none / single / double)
            $table->string('style')->nullable(); // Simple / Design / Custom

            // Pant-specific extras
            $table->decimal('seat', 8, 2)->nullable(); // pant seat / hip
            $table->string('pocket_type')->nullable(); // Cross / Straight
            $table->string('shalwar_type')->nullable(); // Kundo wala / Bagair kundo wala
            $table->decimal('shalwar_asin', 8, 2)->nullable();
            $table->decimal('shalwar_width', 8, 2)->nullable();

            // Misc
            $table->decimal('half_back', 8, 2)->nullable(); // coat
            $table->string('fit_type')->nullable(); // Extra fit option (coat_fit etc.)


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
        Schema::dropIfExists('naaps');
    }
};


 // $table->id();
            // $table->foreignId("customer_id")->constrained()->onDelete("restrict");
            // $table->string("created_by")->nullable();

            // $table->string("type");

            // // PANT
            // $table->decimal("paint_waist", 8, 2)->nullable();
            // $table->decimal("paint_seat_hip", 8, 2)->nullable();
            // $table->decimal("paint_bottom", 8, 2)->nullable();
            // $table->decimal("paint_length", 8, 2)->nullable();
            // $table->string("paint_pocket_style")->nullable();

            // // SHIRT
            // $table->decimal("shirt_length", 8, 2)->nullable();
            // $table->decimal("shirt_chest", 8, 2)->nullable();
            // $table->decimal("shirt_waist", 8, 2)->nullable();
            // $table->decimal("shirt_shoulder", 8, 2)->nullable();
            // $table->decimal("shirt_sleeve", 8, 2)->nullable();
            // $table->decimal("shirt_cuff", 8, 2)->nullable();
            // $table->decimal("shirt_length", 8, 2)->nullable();
            // $table->string("shirt_fit")->nullable(); //SLIM / REGULAR
            // $table->string("shirt_collar")->nullable(); //Spread / Button-down / MANDARIN
            // $table->string("shirt_cuffs")->nullable(); //SINGLE / DOUBLE
            // $table->string("shirt_pocket")->nullable(); // 0 / 1 / 2 ...
            // $table->string("shirt_daman")->nullable(); // SADA / GOOL/ ETC

            // // KAMEEZ
            // $table->decimal("kameez_length", 8, 2)->nullable();
            // $table->decimal("kameez_sleeve", 8, 2)->nullable();
            // $table->decimal("kameez_shoulder", 8, 2)->nullable();
            // $table->decimal("kameez_collar", 8, 2)->nullable();
            // $table->decimal("kameez_chest", 8, 2)->nullable();
            // $table->decimal("kameez_waist", 8, 2)->nullable();
            // $table->decimal("kameez_hip", 8, 2)->nullable();
            // $table->string("kameez_daman")->nullable(); //SADA / GOOL
            // $table->string("kameez_patae")->nullable(); //  simple / sada / nokdar
            // $table->string("kameez_ban")->nullable(); // Full ban caut / half bun cat / Kabali
            // $table->string("kameez_cuff")->nullable(); // Sada  / ool / Studd etc.
            // $table->string("kameez_stitching")->nullable(); // Simple / Chamak / etc 
            // $table->string("kameez_pockets")->nullable(); // Side 1 / front 2 / etc
            // $table->string("kameez_asteen")->nullable(); // one Palet / Two Palet
            // $table->string("kameez_buttons")->nullable(); // one  / Two .. 5
            // $table->string("kameez_btn_style")->nullable(); // simple  / Design

            // // SHALWAR
            // $table->decimal("shalwar_length", 8, 2)->nullable();
            // $table->decimal("shalwar_pancha", 8, 2)->nullable();
            // $table->string("shalwar_type", 8, 2)->nullable(); // kundo wala / bagair kundo wala
            // $table->decimal("shalwar_asin", 8, 2)->nullable();
            // $table->decimal("shalwar_width", 8, 2)->nullable();
            // $table->decimal("shalwar_pocket", 8, 2)->nullable();

            // // COAT
            // $table->decimal("coat_chest", 8, 2)->nullable();
            // $table->decimal("coat_waist", 8, 2)->nullable();
            // $table->decimal("coat_hip", 8, 2)->nullable();
            // $table->decimal("coat_shoulder", 8, 2)->nullable();
            // $table->decimal("coat_sleeve", 8, 2)->nullable();
            // $table->decimal("coat_half_back", 8, 2)->nullable();
            // $table->string("coat_chock")->nullable(); // none / single / double
            // $table->string("coat_fit")->nullable(); // Slim / Regular
            // $table->string("coat_buttons")->nullable(); // 1, 2,3 
            // $table->string("coat_collar")->nullable(); // 1, 2,3 


            // // Waist Coat
            // $table->decimal("waistcoat_chest", 8, 2)->nullable();
            // $table->decimal("waistcoat_waist", 8, 2)->nullable();
            // $table->decimal("waistcoat_shoulder", 8, 2)->nullable();
            // $table->decimal("waistcoat_length", 8, 2)->nullable();
            // $table->decimal("waistcoat_neck_depth", 8, 2)->nullable();
            // $table->string("waistcoat_buttons")->nullable();
            // $table->string("waistcoat_style")->nullable(); // simple / design



            // $table->text("notes");
            // $table->softDeletes();
            // $table->timestamps();