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
        Schema::table('fblog_categories', function (Blueprint $table) {
            $table->string('language')->default('en');
        });
        Schema::table('fblog_posts', function (Blueprint $table) {
            $table->string('language')->default('en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fblog_categories', function (Blueprint $table) {
            $table->dropColumn('language');
        });
        Schema::table('fblog_posts', function (Blueprint $table) {
            $table->dropColumn('language');
        });
    }
};
