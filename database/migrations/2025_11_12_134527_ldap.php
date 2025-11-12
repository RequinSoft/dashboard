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
        Schema::create('ldap_configs', function (Blueprint $table) {
            $table->id();
            $table->string('ip')->nullable();
            $table->string('port')->nullable();
            $table->string('domain');
            $table->string('base_dn')->nullable();
            $table->string('user')->nullable();
            $table->string('password')->nullable();
            $table->integer('version')->default(3);
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ldap_configs');
    }
};
