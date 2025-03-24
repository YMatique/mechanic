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
        ]);
    }
}
