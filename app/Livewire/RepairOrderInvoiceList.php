<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RepairOrderInvoice;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Attributes\Layout;
use App\Exports\RepairOrderInvoicesExport;

class RepairOrderInvoiceList extends Component
{
    use WithPagination;

    public $search = '';
    public $editing = false;
    public $repairOrderInvoiceId;
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
        'accounting_status' => 'required|string|max:255',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function edit($id)
    {
        $repairOrderInvoice = RepairOrderInvoice::findOrFail($id);
        $this->repairOrderInvoiceId = $id;
        $this->stamp = $repairOrderInvoice->stamp;
        $this->repair_order = $repairOrderInvoice->repair_order;
        $this->invoice_date = $repairOrderInvoice->invoice_date;
        $this->invoiced_hours = $repairOrderInvoice->invoiced_hours;
        $this->qty_oxygen = $repairOrderInvoice->qty_oxygen;
        $this->qty_acetylene = $repairOrderInvoice->qty_acetylene;
        $this->qty_propane = $repairOrderInvoice->qty_propane;
        $this->work_state = $repairOrderInvoice->work_state;
        $this->location = $repairOrderInvoice->location;
        $this->accounting_status = $repairOrderInvoice->accounting_status;
        $this->editing = true;
    }

    public function update()
    {
        $this->validate();

        $repairOrderInvoice = RepairOrderInvoice::findOrFail($this->repairOrderInvoiceId);
        $repairOrderInvoice->update([
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

        $this->resetForm();
        session()->flash('success', 'Faturação da ordem de reparação atualizada com sucesso!');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    public function export()
    {
        return Excel::download(new RepairOrderInvoicesExport($this->search), 'repair_order_invoices_' . now()->format('Y-m-d') . '.xlsx');
    }

    private function resetForm()
    {
        $this->editing = false;
        $this->repairOrderInvoiceId = null;
        $this->stamp = null;
        $this->repair_order = null;
        $this->invoice_date = null;
        $this->invoiced_hours = null;
        $this->qty_oxygen = null;
        $this->qty_acetylene = null;
        $this->qty_propane = null;
        $this->work_state = null;
        $this->location = null;
        $this->accounting_status = null;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $repairOrderInvoices = RepairOrderInvoice::where('repair_order', 'like', '%' . $this->search . '%')
            ->orderBy('stamp', 'desc')
            ->paginate(10);
        return view('livewire.repair-order-invoice-list',[
            'repairOrderInvoices' => $repairOrderInvoices,
        ]);
    }
}
