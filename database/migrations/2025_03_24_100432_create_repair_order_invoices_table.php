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
        Schema::create('repair_order_invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamp('stamp'); // Carimbo (data e hora)
            $table->string('repair_order'); // Ordem de Reparação (número e letra)
            $table->date('invoice_date'); // Data Faturação (dia/mês/ano)
            $table->integer('invoiced_hours'); // Horas Faturadas (em horas)
            $table->integer('qty_oxygen')->nullable(); // QTY Oxigênio (Kg)
            $table->integer('qty_acetylene')->nullable(); // QTY Acetileno (Kg)
            $table->integer('qty_propane')->nullable(); // QTY Propano (Kg)
            $table->string('work_state'); // Estado da Obra (somente FECHADO)
            $table->string('location'); // Localização da Obra
            $table->string('accounting_status'); // FACT.-CONTABILIDADE
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_order_invoices');
    }
};
