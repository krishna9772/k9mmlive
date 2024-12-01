<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sport_matches', function (Blueprint $table) {
            $table->string('image')->nullable();   
            $table->longText('description')->nullable()->change();         
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
        Schema::table('sport_matches', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->string('description')->nullable()->change();
        }); 
    }
};
