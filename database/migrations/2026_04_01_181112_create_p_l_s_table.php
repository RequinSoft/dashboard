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
        Schema::create('p_l_s', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pl_person_id')->nullable();
            $table->foreign('pl_person_id')->references('id')->on('p_l_people');

            $table->float('pl')->nullable();
            $table->unsignedMediumInteger('year');
            $table->unsignedTinyInteger('month');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_l_s');
    }
};
