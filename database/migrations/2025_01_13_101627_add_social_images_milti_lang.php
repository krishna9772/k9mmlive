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
        Schema::table('social_links', function (Blueprint $table) {
            $table->text('image_mm')->nullable();   
            $table->text('image_ch')->nullable();               
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sport_matches', function (Blueprint $table) {
            $table->dropColumn('image_mm');
            $table->dropColumn('image_ch');
        });     
    }
};
