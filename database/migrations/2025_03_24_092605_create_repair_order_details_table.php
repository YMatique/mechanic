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
        Schema::create('repair_order_details', function (Blueprint $table) {
            $table->id();
            $table->timestamp('stamp'); // Carimbo (data e hora)
            $table->string('repair_order'); // Ordem de Reparação (número e letra)
            $table->integer('total_time'); // Tempo Total (em minutos)
            $table->foreignId('technician_1_id')->constrained('technicians'); // Técnico 1 (FK)
            $table->integer('hours_tec_1'); // Horas Tec 1 (em minutos)
            $table->foreignId('technician_2_id')->nullable()->constrained('technicians'); // Técnico 2 (opcional)
            $table->integer('hours_tec_2')->nullable(); // Horas Tec 2
            $table->foreignId('technician_3_id')->nullable()->constrained('technicians');
            $table->integer('hours_tec_3')->nullable();
            $table->foreignId('technician_4_id')->nullable()->constrained('technicians');
            $table->integer('hours_tec_4')->nullable();
            $table->foreignId('technician_5_id')->nullable()->constrained('technicians');
            $table->integer('hours_tec_5')->nullable();
            $table->foreignId('technician_6_id')->nullable()->constrained('technicians');
            $table->integer('hours_tec_6')->nullable();
            $table->foreignId('technician_7_id')->nullable()->constrained('technicians');
            $table->integer('hours_tec_7')->nullable();
            $table->foreignId('technician_8_id')->nullable()->constrained('technicians');
            $table->integer('hours_tec_8')->nullable();
            $table->foreignId('technician_9_id')->nullable()->constrained('technicians');
            $table->integer('hours_tec_9')->nullable();
            $table->foreignId('technician_10_id')->nullable()->constrained('technicians');
            $table->integer('hours_tec_10')->nullable();
            $table->string('work_state'); // Estado da Obra
            $table->string('location'); // Localização da Obra
            $table->integer('total_technician_hours')->virtualAs( // Total das horas dos técnicos (calculado)
                'COALESCE(hours_tec_1, 0) + COALESCE(hours_tec_2, 0) + COALESCE(hours_tec_3, 0) + ' .
                'COALESCE(hours_tec_4, 0) + COALESCE(hours_tec_5, 0) + COALESCE(hours_tec_6, 0) + ' .
                'COALESCE(hours_tec_7, 0) + COALESCE(hours_tec_8, 0) + COALESCE(hours_tec_9, 0) + ' .
                'COALESCE(hours_tec_10, 0)'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_order_details');
    }
};
