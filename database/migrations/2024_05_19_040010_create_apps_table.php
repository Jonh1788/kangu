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
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('depositos')->default(0);
            $table->string('saques')->default(0);
            $table->string('usuarios')->default(0);
            $table->string('faturamento')->default(0);
            $table->string('deposito_minimo')->default(1);
            $table->string('saque_minimo')->default(1);
            $table->string('dificuldade_jogo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apps');
    }
};
