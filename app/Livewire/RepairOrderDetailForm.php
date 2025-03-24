<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\RepairOrderDetail;
use App\Models\Technician;

class RepairOrderDetailForm extends Component
{
    public $stamp, $repair_order, $total_time, $technician_1_id, $hours_tec_1;
    public $technician_2_id, $hours_tec_2, $technician_3_id, $hours_tec_3;
    public $technician_4_id, $hours_tec_4, $technician_5_id, $hours_tec_5;
    public $technician_6_id, $hours_tec_6, $technician_7_id, $hours_tec_7;
    public $technician_8_id, $hours_tec_8, $technician_9_id, $hours_tec_9;
    public $technician_10_id, $hours_tec_10, $work_state, $location;

    protected $rules = [
        'stamp' => 'required|date',
        'repair_order' => 'required|string|max:255',
        'total_time' => 'required|integer|min:0',
        'technician_1_id' => 'required|exists:technicians,id',
        'hours_tec_1' => 'required|integer|min:0',
        'technician_2_id' => 'nullable|exists:technicians,id',
        'hours_tec_2' => 'nullable|integer|min:0',
        'technician_3_id' => 'nullable|exists:technicians,id',
        'hours_tec_3' => 'nullable|integer|min:0',
        'technician_4_id' => 'nullable|exists:technicians,id',
        'hours_tec_4' => 'nullable|integer|min:0',
        'technician_5_id' => 'nullable|exists:technicians,id',
        'hours_tec_5' => 'nullable|integer|min:0',
        'technician_6_id' => 'nullable|exists:technicians,id',
        'hours_tec_6' => 'nullable|integer|min:0',
        'technician_7_id' => 'nullable|exists:technicians,id',
        'hours_tec_7' => 'nullable|integer|min:0',
        'technician_8_id' => 'nullable|exists:technicians,id',
        'hours_tec_8' => 'nullable|integer|min:0',
        'technician_9_id' => 'nullable|exists:technicians,id',
        'hours_tec_9' => 'nullable|integer|min:0',
        'technician_10_id' => 'nullable|exists:technicians,id',
        'hours_tec_10' => 'nullable|integer|min:0',
        'work_state' => 'required|in:PENDENTE,EXECUTADO',
        'location' => 'required|in:INSPECCAO-FINAL,SUPERVISAO',
    ];

    public function mount()
    {
        $this->stamp = now()->toDateTimeLocalString();
    }

    public function save()
    {
        $this->validate();

        RepairOrderDetail::create([
            'stamp' => $this->stamp,
            'repair_order' => $this->repair_order,
            'total_time' => $this->total_time,
            'technician_1_id' => $this->technician_1_id,
            'hours_tec_1' => $this->hours_tec_1,
            'technician_2_id' => $this->technician_2_id,
            'hours_tec_2' => $this->hours_tec_2,
            'technician_3_id' => $this->technician_3_id,
            'hours_tec_3' => $this->hours_tec_3,
            'technician_4_id' => $this->technician_4_id,
            'hours_tec_4' => $this->hours_tec_4,
            'technician_5_id' => $this->technician_5_id,
            'hours_tec_5' => $this->hours_tec_5,
            'technician_6_id' => $this->technician_6_id,
            'hours_tec_6' => $this->hours_tec_6,
            'technician_7_id' => $this->technician_7_id,
            'hours_tec_7' => $this->hours_tec_7,
            'technician_8_id' => $this->technician_8_id,
            'hours_tec_8' => $this->hours_tec_8,
            'technician_9_id' => $this->technician_9_id,
            'hours_tec_9' => $this->hours_tec_9,
            'technician_10_id' => $this->technician_10_id,
            'hours_tec_10' => $this->hours_tec_10,
            'work_state' => $this->work_state,
            'location' => $this->location,
        ]);

        $this->reset();
        $this->stamp = now()->toDateTimeLocalString();
        session()->flash('success', 'Detalhes da ordem de reparação registrados com sucesso!');
    }
    #[Layout('layouts.app')]
    public function render()
    {
        $technicians = Technician::all();
        return view('livewire.repair-order-detail-form', compact('technicians'));
    }
}
