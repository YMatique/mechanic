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
        Schema::create('repair_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamp('stamp'); // Carimbo de Data e Hora
            $table->string('repair_order'); // Ordem de Reparação
            $table->string('machine_number'); // Número da Máquina
            $table->string('month_entry', 3); // Mês de Entrada (ex.: JAN, FEV)
            $table->integer('year_entry'); // Ano
            $table->date('date_entry'); // Data de Entrada
            $table->text('breakdown_description'); // Descrição da Avaria
            $table->string('mantainance_type'); // Tipo de Manutenção
            $table->string('applicant'); // Solicitante
            $table->string('work_state'); // Estado da Obra
            $table->string('location'); // Localização da Obra
            $table->string('cliente'); // Cliente
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_orders');
    }
};
