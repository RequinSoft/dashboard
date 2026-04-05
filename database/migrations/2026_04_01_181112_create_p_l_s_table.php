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

            $table->string('PERSONA');
            $table->float('PORCENTAJE_TOTAL')->nullable() ->default(0);
            $table->unsignedMediumInteger('ANIO');
            $table->unsignedTinyInteger('MES');
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
