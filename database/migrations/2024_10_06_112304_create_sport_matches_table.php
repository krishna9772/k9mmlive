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
        Schema::create('sport_matches', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('live_link')->nullable();
            $table->boolean('live_now')->default(0)->nullable();
            $table->unsignedBigInteger('sport_team1_id');
            $table->unsignedBigInteger('sport_team2_id');
            $table->unsignedBigInteger('sport_type_id');
            $table->unsignedBigInteger('sport_season_id');
            $table->unsignedBigInteger('sport_league_id');
            $table->unsignedBigInteger('sport_stage_id')->nullable();
            $table->string('status');
            $table->string('date_time')->datetime();
            $table->unsignedInteger('score1')->nullable();
            $table->unsignedInteger('score2')->nullable();
            $table->string('description')->nullable();
            $table->unsignedInteger('sort')->nullable();
            $table->timestamps();

            $table->foreign('sport_type_id')->references('id')->on('sport_types');
            $table->foreign('sport_season_id')->references('id')->on('sport_seasons');
            $table->foreign('sport_league_id')->references('id')->on('sport_leagues');
            $table->foreign('sport_stage_id')->references('id')->on('sport_stages');
            $table->foreign('sport_team1_id')->references('id')->on('sport_teams');
            $table->foreign('sport_team2_id')->references('id')->on('sport_teams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_matches');
    }
};
