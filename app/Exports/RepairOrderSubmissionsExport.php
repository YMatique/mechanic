<?php

namespace App\Exports;

use App\Models\RepairOrderSubmission;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RepairOrderSubmissionsExport implements FromCollection, WithHeadings, WithMapping
{

    protected $search;

    public function __construct($search = '')
    {
        $this->search = $search;
    }

    public function collection()
    {
        return RepairOrderSubmission::where('repair_order', 'like', '%' . $this->search . '%')
            ->orderBy('stamp', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Carimbo',
            'Ordem de Reparação',
            'Número do Equipamento',
            'Estado da Obra',
            'Localização da Obra',
            'Data de Submissão a CdM',
        ];
    }

    public function map($repairOrderSubmission): array
    {
        \Carbon\Carbon::setLocale('pt_BR');
        return [
            // $repairOrderSubmission->stamp->format('d/m/Y H:i'),
            \Carbon\Carbon::parse($repairOrderSubmission->stamp)->translatedFormat('d/M/Y'),
            $repairOrderSubmission->repair_order,
            $repairOrderSubmission->equipment_number,
            $repairOrderSubmission->work_state,
            $repairOrderSubmission->location,
            $repairOrderSubmission->submission_date->format('d/m/Y'),
        ];
    }
}
