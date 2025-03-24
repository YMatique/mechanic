<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulário 1') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- resources/views/livewire/repair-order-detail-list.blade.php -->

                <div class=" p-6 rounded-lg w-full max-w-6xl mx-auto">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Lista de Detalhes de Ordens de Reparação</h1>

                    <!-- Campo de Busca e Botão de Exportar -->
                    <div class="flex justify-between mb-4">
                        <input type="text" wire:model.debounce.500ms="search" class="w-3/4 p-2 border rounded-lg dark:bg-gray-800" placeholder="Pesquisar por Ordem de Reparação...">
                        <button wire:click="export" class="bg-green-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-700">
                            Exportar Excel
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800 border">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="py-2 px-4 border-b text-left">Carimbo</th>
                                    <th class="py-2 px-4 border-b text-left">Ordem de Reparação</th>
                                    <th class="py-2 px-4 border-b text-left">Tempo Total (min)</th>
                                    <th class="py-2 px-4 border-b text-left">Tec 1 (min)</th>
                                    <th class="py-2 px-4 border-b text-left">Tec 2 (min)</th>
                                    <th class="py-2 px-4 border-b text-left">Tec 3 (min)</th>
                                    <th class="py-2 px-4 border-b text-left">Tec 4 (min)</th>
                                    <th class="py-2 px-4 border-b text-left">Tec 5 (min)</th>
                                    <th class="py-2 px-4 border-b text-left">Total Tec (min)</th>
                                    <th class="py-2 px-4 border-b text-left">Estado</th>
                                    <th class="py-2 px-4 border-b text-left">Localização</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($repairOrderDetails as $detail)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="py-2 px-4 border-b">{{ $detail->stamp }}</td>
                                    <td class="py-2 px-4 border-b">{{ $detail->repair_order }}</td>
                                    <td class="py-2 px-4 border-b">{{ $detail->total_time }}</td>
                                    <td class="py-2 px-4 border-b">{{ $detail->technician1->code }} ({{ $detail->hours_tec_1 }})</td>
                                    <td class="py-2 px-4 border-b">{{ $detail->technician2 ? $detail->technician2->code . ' (' . $detail->hours_tec_2 . ')' : '-' }}</td>
                                    <td class="py-2 px-4 border-b">{{ $detail->technician3 ? $detail->technician3->code . ' (' . $detail->hours_tec_3 . ')' : '-' }}</td>
                                    <td class="py-2 px-4 border-b">{{ $detail->technician4 ? $detail->technician4->code . ' (' . $detail->hours_tec_4 . ')' : '-' }}</td>
                                    <td class="py-2 px-4 border-b">{{ $detail->technician5 ? $detail->technician5->code . ' (' . $detail->hours_tec_5 . ')' : '-' }}</td>
                                    <td class="py-2 px-4 border-b">{{ $detail->total_technician_hours }}</td>
                                    <td class="py-2 px-4 border-b">{{ $detail->work_state }}</td>
                                    <td class="py-2 px-4 border-b">{{ $detail->location }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="11" class="py-2 px-4 text-center">Nenhum registro encontrado.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $repairOrderDetails->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
