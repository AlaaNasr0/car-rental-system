<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['sponser_name', 'sponser_number']);
            $table->string('address');
            $table->unsignedBigInteger('sponsor_id')->nullable();
            $table->foreign('sponsor_id')->references('id')->on('sponsers');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('sponser_name');
            $table->string('sponser_number');
            $table->dropColumn(['address', 'sponsor_id']);
        });
    }
};
