<?php

namespace App\Exports;

use App\Models\RepairOrderActivity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RepairOrderActivitiesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;

    public function __construct($search = '')
    {
        $this->search = $search;
    }

    public function collection()
    {
        return RepairOrderActivity::with('technician')
            ->where('repair_order', 'like', '%' . $this->search . '%')
            ->orderBy('stamp', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Carimbo',
            'Ordem de Reparação',
            'Número do Equipamento',
            'Código do Colaborador',
            '01. Data de Realização',
            'Horas Faturadas (1)',
            '02. Data de Realização',
            'Horas Faturadas (2)',
            'Descrição da Atividade',
            'Cliente',
        ];
    }

    public function map($repairOrderActivity): array
    {
        return [
            $repairOrderActivity->stamp,
            $repairOrderActivity->repair_order,
            $repairOrderActivity->equipment_number,
            $repairOrderActivity->technician->code,
            $repairOrderActivity->execution_date_1->format('d/m/Y'),
            $repairOrderActivity->invoiced_hours_1,
            $repairOrderActivity->execution_date_2 ? $repairOrderActivity->execution_date_2->format('d/m/Y') : '-',
            $repairOrderActivity->invoiced_hours_2 ?? '-',
            $repairOrderActivity->activity_description,
            $repairOrderActivity->client,
        ];
    }
}
