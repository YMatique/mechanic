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
        Schema::create('repair_order_submissions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('stamp'); // Carimbo (data e hora)
            $table->string('repair_order'); // Ordem de Reparação (número e letra)
            $table->string('equipment_number'); // Número do Equipamento (número, letra e caracteres)
            $table->string('work_state'); // Estado da Obra
            $table->string('location'); // Localização da Obra
            $table->date('submission_date'); // Data de Submissão a CdM (dia/mês/ano)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_order_submissions');
    }
};
