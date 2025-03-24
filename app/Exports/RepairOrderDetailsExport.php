<?php

namespace App\Exports;

use App\Models\RepairOrderDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RepairOrderDetailsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;

    public function __construct($search = '')
    {
        $this->search = $search;
    }

    public function collection()
    {
        return RepairOrderDetail::with(['technician1', 'technician2', 'technician3', 'technician4', 'technician5', 'technician6', 'technician7', 'technician8', 'technician9', 'technician10'])
            ->where('repair_order', 'like', '%' . $this->search . '%')
            ->orderBy('stamp', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Carimbo',
            'Ordem de Reparação',
            'Tempo Total (min)',
            'Técnico 1',
            'Horas Tec 1 (min)',
            'Técnico 2',
            'Horas Tec 2 (min)',
            'Técnico 3',
            'Horas Tec 3 (min)',
            'Técnico 4',
            'Horas Tec 4 (min)',
            'Técnico 5',
            'Horas Tec 5 (min)',
            'Técnico 6',
            'Horas Tec 6 (min)',
            'Técnico 7',
            'Horas Tec 7 (min)',
            'Técnico 8',
            'Horas Tec 8 (min)',
            'Técnico 9',
            'Horas Tec 9 (min)',
            'Técnico 10',
            'Horas Tec 10 (min)',
            'Total Horas Técnicos (min)',
            'Estado da Obra',
            'Localização da Obra',
        ];
    }

    public function map($repairOrderDetail): array
    {
        return [
            $repairOrderDetail->stamp,
            $repairOrderDetail->repair_order,
            $repairOrderDetail->total_time,
            $repairOrderDetail->technician1 ? $repairOrderDetail->technician1->code : '-',
            $repairOrderDetail->hours_tec_1,
            $repairOrderDetail->technician2 ? $repairOrderDetail->technician2->code : '-',
            $repairOrderDetail->hours_tec_2 ?? '-',
            $repairOrderDetail->technician3 ? $repairOrderDetail->technician3->code : '-',
            $repairOrderDetail->hours_tec_3 ?? '-',
            $repairOrderDetail->technician4 ? $repairOrderDetail->technician4->code : '-',
            $repairOrderDetail->hours_tec_4 ?? '-',
            $repairOrderDetail->technician5 ? $repairOrderDetail->technician5->code : '-',
            $repairOrderDetail->hours_tec_5 ?? '-',
            $repairOrderDetail->technician6 ? $repairOrderDetail->technician6->code : '-',
            $repairOrderDetail->hours_tec_6 ?? '-',
            $repairOrderDetail->technician7 ? $repairOrderDetail->technician7->code : '-',
            $repairOrderDetail->hours_tec_7 ?? '-',
            $repairOrderDetail->technician8 ? $repairOrderDetail->technician8->code : '-',
            $repairOrderDetail->hours_tec_8 ?? '-',
            $repairOrderDetail->technician9 ? $repairOrderDetail->technician9->code : '-',
            $repairOrderDetail->hours_teceds_9 ?? '-',
            $repairOrderDetail->technician10 ? $repairOrderDetail->technician10->code : '-',
            $repairOrderDetail->hours_tec_10 ?? '-',
            $repairOrderDetail->total_technician_hours,
            $repairOrderDetail->work_state,
            $repairOrderDetail->location,
        ];
    }
}
