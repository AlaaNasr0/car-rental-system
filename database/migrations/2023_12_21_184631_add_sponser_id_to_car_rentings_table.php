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
        Schema::table('car_rentings', function (Blueprint $table) {
            $table->unsignedBigInteger('sponsor_id')->nullable()->after('car_id');
            $table->foreign('sponsor_id')->references('id')->on('sponsers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_rentings', function (Blueprint $table) {
            $table->dropColumn('sponsor_id');
        });
    }
};
