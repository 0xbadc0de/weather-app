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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('notifications_enabled')->default(true)->after('profile_photo_path');
            $table->timestamp('notifications_paused')->nullable()->after('notifications_enabled');

            $table->index(['notifications_enabled', 'notifications_paused'], 'notifications_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('notifications_idx');
            $table->dropColumn('notifications_enabled');
            $table->dropColumn('notifications_paused');
        });
    }
};
