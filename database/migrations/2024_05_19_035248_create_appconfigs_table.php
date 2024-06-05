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
        Schema::create('appconfigs', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->string('telefone');
            $table->string('cpf')->nullable();
            $table->string('saldo')->default(0);
            $table->string('senha');
            $table->string('linkafiliado')->nullable();
            $table->string('depositos')->default(0);
            $table->string('saques')->default(0);
            $table->string('saldo_comissao')->default(0);
            $table->string('percas')->default(0);
            $table->string('ganhos')->default(0);
            $table->string('primeiro_deposito')->default('0');
            $table->string('status_primeiro_deposito')->default('0');
            $table->string('afiliado')->default('0');
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appconfigs');
    }
};
