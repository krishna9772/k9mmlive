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
        Schema::create('sport_stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sport_type_id');
            $table->string('name');
            $table->string('status');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('sport_type_id')->references('id')->on('sport_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_stages');
    }
};
