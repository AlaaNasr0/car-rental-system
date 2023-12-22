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
        Schema::table('sponsers', function (Blueprint $table) {
            $table->unsignedBigInteger('car_id')->nullable()->after('client_id');
            $table->foreign('car_id')->references('id')->on('cars');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sponsers', function (Blueprint $table) {
            $table->dropColumn('car_id');
        });
    }
};
