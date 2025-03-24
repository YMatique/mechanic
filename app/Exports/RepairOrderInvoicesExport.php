<?php

namespace App\Exports;

use App\Models\RepairOrderInvoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RepairOrderInvoicesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;

    public function __construct($search = '')
    {
        $this->search = $search;
    }

    public function collection()
    {
        return RepairOrderInvoice::where('repair_order', 'like', '%' . $this->search . '%')
            ->orderBy('stamp', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Carimbo',
            'Ordem de Reparação',
            'Data de Faturação',
            'Horas Faturadas',
            'Oxigênio (Kg)',
            'Acetileno (Kg)',
            'Propano (Kg)',
            'Estado da Obra',
            'Localização da Obra',
            'FACT.-CONTABILIDADE',
        ];
    }

    public function map($repairOrderInvoice): array
    {
        return [
            $repairOrderInvoice->stamp,
            $repairOrderInvoice->repair_order,
            $repairOrderInvoice->invoice_date,
            $repairOrderInvoice->invoiced_hours,
            $repairOrderInvoice->qty_oxygen ?? '-',
            $repairOrderInvoice->qty_acetylene ?? '-',
            $repairOrderInvoice->qty_propane ?? '-',
            $repairOrderInvoice->work_state,
            $repairOrderInvoice->location,
            $repairOrderInvoice->accounting_status,
        ];
    }
}
