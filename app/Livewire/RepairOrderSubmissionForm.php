<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\RepairOrderSubmission;

class RepairOrderSubmissionForm extends Component
{
    public $stamp, $repair_order, $equipment_number, $work_state, $location, $submission_date;

    protected $rules = [
        'stamp' => 'required|date',
        'repair_order' => 'required|string|max:255',
        'equipment_number' => 'required|string|max:255',
        'work_state' => 'required|in:PROCESS.-FACT,FECHADO',
        'location' => 'required|in:FACT.-CDM,FACT.-DANMO',
        'submission_date' => 'required|date',
    ];

    public function mount()
    {
        $this->stamp = now()->toDateTimeLocalString();
    }

    public function save()
    {
        $this->validate();

        RepairOrderSubmission::create([
            'stamp' => $this->stamp,
            'repair_order' => $this->repair_order,
            'equipment_number' => $this->equipment_number,
            'work_state' => $this->work_state,
            'location' => $this->location,
            'submission_date' => $this->submission_date,
        ]);

        $this->reset();
        $this->stamp = now()->toDateTimeLocalString();
        session()->flash('success', 'Submissão da ordem de reparação registrada com sucesso!');
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.repair-order-submission-form');
    }
}
