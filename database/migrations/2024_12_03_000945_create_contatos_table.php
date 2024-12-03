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
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente');
            $table->string('nome_contato');
            $table->string('email_contato');
            $table->string('fone_contato', 11);
            $table->string('cpf', 11);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_cliente')->references('id')->on('clientes');
            
            $table->unique(['email_contato', 'fone_contato', 'id_cliente']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contatos');
    }
};
