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

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.repair-order-list');
    }
}
