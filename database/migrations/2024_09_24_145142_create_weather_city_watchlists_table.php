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
        Schema::create('weather_city_watchlist', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('precipitation_threshold')->nullable();
            $table->unsignedBigInteger('uv_threshold')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->index(['user_id', 'precipitation_threshold', 'uv_threshold'], 'weather_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_city_watchlist');
    }
};
