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
        Schema::create('config_pi', function (Blueprint $table) {
            $table->id();
            $table->string('ip_pi');
            $table->string('port_pi')->nullable();
            $table->string('ip_af');
            $table->string('port_af')->nullable();
            $table->string('user')->nullable();
            $table->string('password')->nullable();
            $table->boolean('activo')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_pi');
    }
};
