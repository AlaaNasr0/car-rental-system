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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->boolean('hasRented');
            $table->unsignedInteger('number_of_rents')->default(0);
            $table->string('sponser_name')->nullable();
            $table->unsignedBigInteger('sponser_number')->nullable();
            $table->string('front_id_image');
            $table->string('back_id_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
