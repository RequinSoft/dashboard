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
        Schema::create('molienda_turno', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->float('plan');
            $table->float('primer_turno');
            $table->float('segundo_turno');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('molienda_turno');
    }
};
