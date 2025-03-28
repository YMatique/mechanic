<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\RepairOrderSubmission;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RepairOrderSubmissionsExport;

class RepairOrderSubmissionList extends Component
{
    use WithPagination;

    public $search = '';
    public $editing = false;
    public $repairOrderSubmissionId;
    public $stamp, $repair_order, $equipment_number, $work_state, $location, $submission_date;

    protected $rules = [
        'stamp' => 'required|date',
        'repair_order' => 'required|string|max:255',
        'equipment_number' => 'required|string|max:255',
        'work_state' => 'required|in:PROCESS.-FACT,FECHADO',
        'location' => 'required|in:FACT.-CDM,FACT.-DANMO',
        'submission_date' => 'required|date',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function edit($id)
    {
        $repairOrderSubmission = RepairOrderSubmission::findOrFail($id);
        $this->repairOrderSubmissionId = $id;
        $this->stamp = $repairOrderSubmission->stamp;
        $this->repair_order = $repairOrderSubmission->repair_order;
        $this->equipment_number = $repairOrderSubmission->equipment_number;
        $this->work_state = $repairOrderSubmission->work_state;
        $this->location = $repairOrderSubmission->location;
        $this->submission_date = $repairOrderSubmission->submission_date->toDateString();
        $this->editing = true;
    }

    public function update()
    {
        $this->validate();

        $repairOrderSubmission = RepairOrderSubmission::findOrFail($this->repairOrderSubmissionId);
        $repairOrderSubmission->update([
            'stamp' => $this->stamp,
            'repair_order' => $this->repair_order,
            'equipment_number' => $this->equipment_number,
            'work_state' => $this->work_state,
            'location' => $this->location,
            'submission_date' => $this->submission_date,
        ]);

        $this->resetForm();
        session()->flash('success', 'Submissão da ordem de reparação atualizada com sucesso!');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    public function export()
    {
        return Excel::download(new RepairOrderSubmissionsExport($this->search), 'repair_order_submissions_' . now()->format('Y-m-d') . '.xlsx');
    }

    private function resetForm()
    {
        $this->editing = false;
        $this->repairOrderSubmissionId = null;
        $this->stamp = null;
        $this->repair_order = null;
        $this->equipment_number = null;
        $this->work_state = null;
        $this->location = null;
        $this->submission_date = null;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $repairOrderSubmissions = RepairOrderSubmission::where('repair_order', 'like', '%' . $this->search . '%')
            ->orderBy('stamp', 'desc')
            ->paginate(10);

        return view('livewire.repair-order-submission-list', [
            'repairOrderSubmissions' => $repairOrderSubmissions,
        ]);
        // return view('livewire.repair-order-submission-list');
    }
}
