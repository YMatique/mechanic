<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RepairOrderActivity;
use App\Models\Technician;
use Livewire\Attributes\Layout;

class RepairOrderActivityForm extends Component
{
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

    public function mount()
    {
        $this->stamp = now()->toDateTimeLocalString();
    }

    public function save()
    {
        $this->validate();

        RepairOrderActivity::create([
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

        $this->reset();
        $this->stamp = now()->toDateTimeLocalString();
        session()->flash('success', 'Atividade da ordem de reparação registrada com sucesso!');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $technicians = Technician::all();
        return view('livewire.repair-order-activity-form', compact('technicians'));
    }
    // public function render()
    // {
    //     return view('livewire.repair-order-activity-form');
    // }
}
