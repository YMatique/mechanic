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
        Schema::create('repair_order_activities', function (Blueprint $table) {
            $table->id();
            $table->timestamp('stamp'); // Carimbo (data e hora)
            $table->string('repair_order'); // Ordem de Reparação (número e letra)
            $table->string('equipment_number'); // Número do Equipamento (número, letra e caracteres)
            $table->foreignId('technician_id')->constrained('technicians'); // Código do Colaborador (FK para technicians)
            $table->date('execution_date_1'); // 01. Data de Realização (dia/mês/ano)
            $table->integer('invoiced_hours_1'); // Horas Faturadas (1)
            $table->date('execution_date_2')->nullable(); // 02. Data de Realização (opcional)
            $table->integer('invoiced_hours_2')->nullable(); // Horas Faturadas (2, opcional)
            $table->string('activity_description'); // Descrição da Atividade
            $table->string('client'); // Cliente (apenas uma opção)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_order_activities');
    }
};
