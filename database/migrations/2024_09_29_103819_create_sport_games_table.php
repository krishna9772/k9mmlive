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
        Schema::create('sport_games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sport_type_id');
            $table->unsignedBigInteger('team1_id');
            $table->unsignedBigInteger('team2_id');
            $table->unsignedBigInteger('sport_league_id')->nullable();
            $table->unsignedBigInteger('sport_season_id')->nullable();
            $table->unsignedBigInteger('sport_stage_id')->nullable();
            $table->unsignedInteger('score1');
            $table->unsignedInteger('score2');
            $table->string('note')->nullable();
            $table->string('status');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('sport_type_id')->references('id')->on('sport_types');
            $table->foreign('team1_id')->references('id')->on('sport_teams');
            $table->foreign('team2_id')->references('id')->on('sport_teams');
            $table->foreign('sport_league_id')->references('id')->on('sport_leagues');
            $table->foreign('sport_season_id')->references('id')->on('sport_seasons');
            $table->foreign('sport_stage_id')->references('id')->on('sport_stages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_games');
    }
};
