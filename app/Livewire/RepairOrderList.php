<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RepairOrder;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;


class RepairOrderList extends Component
{
    use WithPagination;

    // Propriedade para busca (opcional)
    public $search = '';
// Atualiza a paginação quando a busca mudar
// public $search = '';
    public $editing = false;
    public $repairOrderId;
    public $stamp, $repair_order, $machine_number, $month_entry, $year_entry, $date_entry, $breakdown_description, $mantainance_type, $applicant, $work_state, $location, $cliente;

    protected $rules = [
        'stamp' => 'required|date',
        'repair_order' => 'required|string|max:255',
        'machine_number' => 'required|string|max:255',
        'month_entry' => 'required|in:JAN,FEV,MAR,ABR,MAI,JUN,JUL,AGO,SET,OUT,NOV,DEZ',
        'year_entry' => 'required|integer|min:2000|max:2100',
        'date_entry' => 'required|date',
        'breakdown_description' => 'required|string',
        'mantainance_type' => 'required|in:CORRECTIVA,REVISAO,REVISAO E INSPEÇÃO GERAL (PLAT),INSPEÇÃO GERAL,ACIDENTE,PNEU',
        'applicant' => 'required|in:PIQUETE (OPEN),PIQUETE (EXECUTADO),INSPEÇÃO,SUPERVISÃO,NORMAL,UT-CDM',
        'work_state' => 'required|in:PENDENTE,EXECUTADO,EM EXECUÇÃO,FECHADO',
        'location' => 'required|in:INSPEÇÃO-INICIAL,SUPERVISÃO (ELECT),SUPERVISÃO (MEC),SUPERVISÃO (SER),OFICINA,INSPEÇÃO-FINAL,FACT.-DANMO',
        'cliente' => 'required|in:CORNELDER,CCIS,MTM,ACCESS WORLD,STEINWEG BRIDGE,INTERNO,OTHER',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Carregar dados para edição
    public function edit($id)
    {
        $repairOrder = RepairOrder::findOrFail($id);
        $this->repairOrderId = $id;
        $this->stamp = $repairOrder->stamp;
        $this->repair_order = $repairOrder->repair_order;
        $this->machine_number = $repairOrder->machine_number;
        $this->month_entry = $repairOrder->month_entry;
        $this->year_entry = $repairOrder->year_entry;
        $this->date_entry = $repairOrder->date_entry;
        $this->breakdown_description = $repairOrder->breakdown_description;
        $this->mantainance_type = $repairOrder->mantainance_type;
        $this->applicant = $repairOrder->applicant;
        $this->work_state = $repairOrder->work_state;
        $this->location = $repairOrder->location;
        $this->cliente = $repairOrder->cliente;
        $this->editing = true;
    }

    // Salvar edição
    public function update()
    {
        $this->validate();

        $repairOrder = RepairOrder::findOrFail($this->repairOrderId);
        $repairOrder->update([
            'stamp' => $this->stamp,
            'repair_order' => $this->repair_order,
            'machine_number' => $this->machine_number,
            'month_entry' => $this->month_entry,
            'year_entry' => $this->year_entry,
            'date_entry' => $this->date_entry,
            'breakdown_description' => $this->breakdown_description,
            'mantainance_type' => $this->mantainance_type,
            'applicant' => $this->applicant,
            'work_state' => $this->work_state,
            'location' => $this->location,
            'cliente' => $this->cliente,
        ]);

        $this->resetForm();
        session()->flash('success', 'Ordem de reparação atualizada com sucesso!');
    }

    // Cancelar edição
    public function cancelEdit()
    {
        $this->resetForm();
    }

    // Exportar para CSV
    public function export()
    {
        // return Excel::download(new RepairOrdersExport($this->search), 'repair_orders_' . now()->format('Y-m-d') . '.csv');
    }

    private function resetForm()
    {
        $this->editing = false;
        $this->repairOrderId = null;
        $this->stamp = null;
        $this->repair_order = null;
        $this->machine_number = null;
        $this->month_entry = null;
        $this->year_entry = null;
        $this->date_entry = null;
        $this->breakdown_description = null;
        $this->mantainance_type = null;
        $this->applicant = null;
        $this->work_state = null;
        $this->location = null;
        $this->cliente = null;
    }
// public function updatingSearch()
// {
//     $this->resetPage();
// }
    #[Layout('layouts.app')]
    public function render()
    {
        $repairOrders = RepairOrder::where('repair_order', 'like', '%' . $this->search . '%')
            ->orWhere('machine_number', 'like', '%' . $this->search . '%')
            ->orWhere('breakdown_description', 'like', '%' . $this->search . '%')
            ->orderBy('stamp', 'desc')
            ->paginate(10);
        return view('livewire.repair-order-list',[
            'repairOrders' => $repairOrders,
        ]);
    }
}
