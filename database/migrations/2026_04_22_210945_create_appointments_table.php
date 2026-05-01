<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Criando a tabela de agendamentos
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('client');
            $table->date('date');
            $table->string('weekday');
            $table->time('start');
            $table->time('end');
            $table->tinyInteger('status')->default(0);
            $table->string('color')->default('#301d53');
            $table->timestamps();
        });
    }

    /**
     * Reverte as tabelas
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
