<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RepairOrderDetail;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RepairOrderDetailsExport;

class RepairOrderDetailList extends Component
{
    use WithPagination;

    public $search = '';
    public $editing = false;
    public $repairOrderDetailId;
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

    private function resetForm()
    {
        $this->editing = false;
        $this->repairOrderDetailId = null;
        $this->stamp = null;
        $this->repair_order = null;
        $this->total_time = null;
        $this->technician_1_id = null;
        $this->hours_tec_1 = null;
        $this->technician_2_id = null;
        $this->hours_tec_2 = null;
        $this->technician_3_id = null;
        $this->hours_tec_3 = null;
        $this->technician_4_id = null;
        $this->hours_tec_4 = null;
        $this->technician_5_id = null;
        $this->hours_tec_5 = null;
        $this->technician_6_id = null;
        $this->hours_tec_6 = null;
        $this->technician_7_id = null;
        $this->hours_tec_7 = null;
        $this->technician_8_id = null;
        $this->hours_tec_8 = null;
        $this->technician_9_id = null;
        $this->hours_tec_9 = null;
        $this->technician_10_id = null;
        $this->hours_tec_10 = null;
        $this->work_state = null;
        $this->location = null;
    }

    public function edit($id)
    {
        $repairOrderDetail = RepairOrderDetail::findOrFail($id);
        $this->repairOrderDetailId = $id;
        $this->stamp = $repairOrderDetail->stamp;
        $this->repair_order = $repairOrderDetail->repair_order;
        $this->total_time = $repairOrderDetail->total_time;
        $this->technician_1_id = $repairOrderDetail->technician_1_id;
        $this->hours_tec_1 = $repairOrderDetail->hours_tec_1;
        $this->technician_2_id = $repairOrderDetail->technician_2_id;
        $this->hours_tec_2 = $repairOrderDetail->hours_tec_2;
        $this->technician_3_id = $repairOrderDetail->technician_3_id;
        $this->hours_tec_3 = $repairOrderDetail->hours_tec_3;
        $this->technician_4_id = $repairOrderDetail->technician_4_id;
        $this->hours_tec_4 = $repairOrderDetail->hours_tec_4;
        $this->technician_5_id = $repairOrderDetail->technician_5_id;
        $this->hours_tec_5 = $repairOrderDetail->hours_tec_5;
        $this->technician_6_id = $repairOrderDetail->technician_6_id;
        $this->hours_tec_6 = $repairOrderDetail->hours_tec_6;
        $this->technician_7_id = $repairOrderDetail->technician_7_id;
        $this->hours_tec_7 = $repairOrderDetail->hours_tec_7;
        $this->technician_8_id = $repairOrderDetail->technician_8_id;
        $this->hours_tec_8 = $repairOrderDetail->hours_tec_8;
        $this->technician_9_id = $repairOrderDetail->technician_9_id;
        $this->hours_tec_9 = $repairOrderDetail->hours_tec_9;
        $this->technician_10_id = $repairOrderDetail->technician_10_id;
        $this->hours_tec_10 = $repairOrderDetail->hours_tec_10;
        $this->work_state = $repairOrderDetail->work_state;
        $this->location = $repairOrderDetail->location;
        $this->editing = true;
    }

    public function update()
    {
        $this->validate();

        $repairOrderDetail = RepairOrderDetail::findOrFail($this->repairOrderDetailId);
        $repairOrderDetail->update([
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

        $this->resetForm();
        session()->flash('success', 'Detalhes da ordem de reparação atualizados com sucesso!');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function export()
    {
        return Excel::download(new RepairOrderDetailsExport($this->search), 'repair_order_details_' . now()->format('Y-m-d') . '.xlsx');
    }
    #[Layout('layouts.app')]
    public function render()
    {
        $repairOrderDetails = RepairOrderDetail::with(['technician1', 'technician2', 'technician3', 'technician4', 'technician5', 'technician6', 'technician7', 'technician8', 'technician9', 'technician10'])
            ->where('repair_order', 'like', '%' . $this->search . '%')
            ->orderBy('stamp', 'desc')
            ->paginate(10);

        return view('livewire.repair-order-detail-list',[
            'repairOrderDetails' => $repairOrderDetails,
            'technicians' => \App\Models\Technician::all(),
        ]);
    }
}
