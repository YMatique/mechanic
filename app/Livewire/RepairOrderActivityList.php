<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RepairOrderActivity;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RepairOrderActivitiesExport;
use Livewire\Attributes\Layout;

class RepairOrderActivityList extends Component
{
    use WithPagination;

    public $search = '';
    public $editing = false;
    public $repairOrderActivityId;
    public $stamp, $repair_order, $equipment_number, $technician_id, $execution_date_1, $invoiced_hours_1;
    public $execution_date_2, $invoiced_hours_2, $activity_description, $client;

    protected $rules = [
        'stamp' => 'required|date',
        'repair_order' => 'required|string|max:255',
        'equipment_number' => 'required|string|max:255',
        'technician_id' => 'required|exists:technicians,id',
        'execution_date_1' => 'required|date',
        'invoiced_hours_1' => 'required|integer|min:0',
        'execution_date_2' => 'nullable|date',
        'invoiced_hours_2' => 'nullable|integer|min:0',
        'activity_description' => 'required|string|max:255',
        'client' => 'required|in:CORNELDER,CCIS,MTM,ACCESS WORLD,OTHER',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function edit($id)
    {
        $repairOrderActivity = RepairOrderActivity::findOrFail($id);
        $this->repairOrderActivityId = $id;
        $this->stamp = $repairOrderActivity->stamp->toDateTimeLocalString();
        $this->repair_order = $repairOrderActivity->repair_order;
        $this->equipment_number = $repairOrderActivity->equipment_number;
        $this->technician_id = $repairOrderActivity->technician_id;
        $this->execution_date_1 = $repairOrderActivity->execution_date_1->toDateString();
        $this->invoiced_hours_1 = $repairOrderActivity->invoiced_hours_1;
        $this->execution_date_2 = $repairOrderActivity->execution_date_2?->toDateString();
        $this->invoiced_hours_2 = $repairOrderActivity->invoiced_hours_2;
        $this->activity_description = $repairOrderActivity->activity_description;
        $this->client = $repairOrderActivity->client;
        $this->editing = true;
    }

    public function update()
    {
        $this->validate();

        $repairOrderActivity = RepairOrderActivity::findOrFail($this->repairOrderActivityId);
        $repairOrderActivity->update([
            'stamp' => $this->stamp,
            'repair_order' => $this->repair_order,
            'equipment_number' => $this->equipment_number,
            'technician_id' => $this->technician_id,
            'execution_date_1' => $this->execution_date_1,
            'invoiced_hours_1' => $this->invoiced_hours_1,
            'execution_date_2' => $this->execution_date_2,
            'invoiced_hours_2' => $this->invoiced_hours_2,
            'activity_description' => $this->activity_description,
            'client' => $this->client,
        ]);

        $this->resetForm();
        session()->flash('success', 'Atividade da ordem de reparação atualizada com sucesso!');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    public function export()
    {
        return Excel::download(new RepairOrderActivitiesExport($this->search), 'repair_order_activities_' . now()->format('Y-m-d') . '.xlsx');
    }

    private function resetForm()
    {
        $this->editing = false;
        $this->repairOrderActivityId = null;
        $this->stamp = null;
        $this->repair_order = null;
        $this->equipment_number = null;
        $this->technician_id = null;
        $this->execution_date_1 = null;
        $this->invoiced_hours_1 = null;
        $this->execution_date_2 = null;
        $this->invoiced_hours_2 = null;
        $this->activity_description = null;
        $this->client = null;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $repairOrderActivities = RepairOrderActivity::with('technician')
            ->where('repair_order', 'like', '%' . $this->search . '%')
            ->orderBy('stamp', 'desc')
            ->paginate(10);

        $technicians = \App\Models\Technician::all();

        return view('livewire.repair-order-activity-list', [
            'repairOrderActivities' => $repairOrderActivities,
            'technicians' => $technicians,
        ]);
    }
    // public function render()
    // {
    //     return view('livewire.repair-order-activity-list');
    // }
}
