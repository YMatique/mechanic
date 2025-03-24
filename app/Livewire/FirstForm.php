<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\RepairOrder;

class FirstForm extends Component
{
    public $stamp;
    public $repair_order;
    public $machine_number;
    public $month_entry;
    public $year_entry;
    public $date_entry;
    public $breakdown_description;
    public $mantainance_type;
    public $applicant;
    public $work_state;
    public $location;
    public $cliente;
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
    public function mount()
    {
        // $this->stamp = now()->toDateTimeLocalString(); // Preenche com data/hora atual
    }
    public function save()
    {
        // Validar os dados
        $this->validate();

        // Salvar no banco de dados
        RepairOrder::create([
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

        // Limpar o formulário após o envio
        $this->reset();

        // Preencher novamente o carimbo com a data/hora atual
        $this->stamp = now()->toDateTimeLocalString();

        // Emitir mensagem de sucesso
        session()->flash('success', 'Ordem de reparação registrada com sucesso!');
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.first-form');
    }
}
