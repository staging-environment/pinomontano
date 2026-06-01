<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('social_posts', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
        });

        Schema::table('social_posts', function (Blueprint $table) {
            $table->foreignId('business_id')->nullable()->change();
        });

        Schema::table('social_posts', function (Blueprint $table) {
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_posts', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
        });

        Schema::table('social_posts', function (Blueprint $table) {
            // Note: If there are null business_id rows, down migration might fail, which is expected behaviour
            $table->foreignId('business_id')->nullable(false)->change();
        });

        Schema::table('social_posts', function (Blueprint $table) {
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
        });
    }
};
