<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RepairOrderInvoice;
use Livewire\Attributes\Layout;

class RepairOrderInvoiceForm extends Component
{
    public $stamp, $repair_order, $invoice_date, $invoiced_hours, $qty_oxygen, $qty_acetylene, $qty_propane, $work_state, $location, $accounting_status;

    protected $rules = [
        'stamp' => 'required|date',
        'repair_order' => 'required|string|max:255',
        'invoice_date' => 'required|date',
        'invoiced_hours' => 'required|integer|min:0',
        'qty_oxygen' => 'nullable|integer|min:0',
        'qty_acetylene' => 'nullable|integer|min:0',
        'qty_propane' => 'nullable|integer|min:0',
        'work_state' => 'required|in:FECHADO',
        'location' => 'required|in:FACT.-DANMO,FACT.-CONTABILIDADE',
        'accounting_status' => 'required|string|max:255', // Pode ser ajustado conforme opções específicas
    ];
    public function mount()
    {
        $this->stamp = now()->toDateTimeLocalString();
        $this->work_state = 'FECHADO'; // Valor fixo
    }

    public function save()
    {
        $this->validate();

        RepairOrderInvoice::create([
            'stamp' => $this->stamp,
            'repair_order' => $this->repair_order,
            'invoice_date' => $this->invoice_date,
            'invoiced_hours' => $this->invoiced_hours,
            'qty_oxygen' => $this->qty_oxygen,
            'qty_acetylene' => $this->qty_acetylene,
            'qty_propane' => $this->qty_propane,
            'work_state' => $this->work_state,
            'location' => $this->location,
            'accounting_status' => $this->accounting_status,
        ]);

        $this->reset();
        $this->stamp = now()->toDateTimeLocalString();
        $this->work_state = 'FECHADO';
        session()->flash('success', 'Faturação da ordem de reparação registrada com sucesso!');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.repair-order-invoice-form');
    }
}
