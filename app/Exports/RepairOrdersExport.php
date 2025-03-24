<?php

namespace App\Exports;

use App\Models\RepairOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RepairOrdersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;

    public function __construct($search = '')
    {
        $this->search = $search;
    }

    public function collection()
    {
        return RepairOrder::where('repair_order', 'like', '%' . $this->search . '%')
            ->orWhere('machine_number', 'like', '%' . $this->search . '%')
            ->orWhere('breakdown_description', 'like', '%' . $this->search . '%')
            ->orderBy('stamp', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Carimbo',
            'Ordem de Reparação',
            'Número da Máquina',
            'Mês',
            'Ano',
            'Data de Entrada',
            'Descrição da Avaria',
            'Tipo de Manutenção',
            'Solicitante',
            'Estado da Obra',
            'Localização da Obra',
            'Cliente',
        ];
    }

    public function map($repairOrder): array
    {
        \Carbon\Carbon::setLocale('pt_BR');
                                        // $formattedDate = \Carbon\Carbon::parse($order->stamp)->translatedFormat('d M, Y');
        return [
            \Carbon\Carbon::parse($repairOrder->stamp)->translatedFormat('d/M/Y'),
            $repairOrder->repair_order,
            $repairOrder->machine_number,
            $repairOrder->month_entry,
             $repairOrder->year_entry, 
            // $repairOrder->date_entry->format('d/m/Y'),
            \Carbon\Carbon::parse($repairOrder->date_entry)->translatedFormat('d/M/Y'),
            $repairOrder->breakdown_description,
            $repairOrder->mantainance_type,
            $repairOrder->applicant,
            $repairOrder->work_state,
            $repairOrder->location,
            $repairOrder->cliente,
        ];
    }
}
