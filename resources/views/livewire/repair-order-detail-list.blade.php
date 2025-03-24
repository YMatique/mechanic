<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes Ordem de Reparação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- resources/views/livewire/repair-order-detail-list.blade.php -->

                <div class=" p-6 rounded-lg w-full max-w-6xl mx-auto">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Lista de Detalhes de Ordens de Reparação</h1>

                    @if (session()->has('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Campo de Busca e Botão de Exportar -->
                    <div class="flex justify-between mb-4">
                        <input type="text" wire:model.debounce.500ms="search" class="w-3/4 p-2 border rounded-lg dark:bg-gray-800" placeholder="Pesquisar por Ordem de Reparação...">
                        <button wire:click="export" class="bg-green-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-700">
                            Exportar Excel
                        </button>
                    </div>

                    <!-- Formulário de Edição -->
                    @if ($editing)
                    <div class="mb-6 p-4 border rounded-lg ">
                        <h2 class="text-xl font-semibold mb-4 dark:text-gray-300">Editar Detalhes da Ordem de Reparação</h2>
                        <form wire:submit.prevent="update" class="flex flex-col gap-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Carimbo de Data e Hora</label>
                                    <input type="datetime-local" wire:model="stamp" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('stamp') border-red-500 @enderror" required>
                                    @error('stamp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Ordem de Reparação</label>
                                    <input type="text" wire:model="repair_order" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('repair_order') border-red-500 @enderror" required>
                                    @error('repair_order') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Tempo Total (minutos)</label>
                                    <input type="number" wire:model="total_time" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('total_time') border-red-500 @enderror" min="0" required>
                                    @error('total_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <!-- Técnico 1 -->
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Técnico 1</label>
                                    <select wire:model="technician_1_id" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('technician_1_id') border-red-500 @enderror" required>
                                        <option value="" disabled>Selecione o técnico</option>
                                        @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}">{{ $technician->code }} - {{ $technician->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('technician_1_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Horas Tec 1 (minutos)</label>
                                    <input type="number" wire:model="hours_tec_1" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('hours_tec_1') border-red-500 @enderror" min="0" required>
                                    @error('hours_tec_1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <!-- Técnico 2 -->
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Técnico 2</label>
                                    <select wire:model="technician_2_id" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('technician_2_id') border-red-500 @enderror">
                                        <option value="">Nenhum</option>
                                        @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}">{{ $technician->code }} - {{ $technician->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('technician_2_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Horas Tec 2 (minutos)</label>
                                    <input type="number" wire:model="hours_tec_2" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('hours_tec_2') border-red-500 @enderror" min="0">
                                    @error('hours_tec_2') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <!-- Técnico 3 -->
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Técnico 3</label>
                                    <select wire:model="technician_3_id" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('technician_3_id') border-red-500 @enderror">
                                        <option value="">Nenhum</option>
                                        @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}">{{ $technician->code }} - {{ $technician->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('technician_3_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Horas Tec 3 (minutos)</label>
                                    <input type="number" wire:model="hours_tec_3" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('hours_tec_3') border-red-500 @enderror" min="0">
                                    @error('hours_tec_3') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <!-- Adicionar os outros técnicos (4 a 10) de forma semelhante -->
                                <!-- Técnico 4 -->
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Técnico 4</label>
                                    <select wire:model="technician_4_id" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('technician_4_id') border-red-500 @enderror">
                                        <option value="">Nenhum</option>
                                        @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}">{{ $technician->code }} - {{ $technician->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('technician_4_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Horas Tec 4 (minutos)</label>
                                    <input type="number" wire:model="hours_tec_4" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('hours_tec_4') border-red-500 @enderror" min="0">
                                    @error('hours_tec_4') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <!-- Técnico 5 -->
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Técnico 5</label>
                                    <select wire:model="technician_5_id" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('technician_5_id') border-red-500 @enderror">
                                        <option value="">Nenhum</option>
                                        @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}">{{ $technician->code }} - {{ $technician->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('technician_5_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Horas Tec 5 (minutos)</label>
                                    <input type="number" wire:model="hours_tec_5" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('hours_tec_5') border-red-500 @enderror" min="0">
                                    @error('hours_tec_5') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <!-- Técnico 6 -->
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Técnico 6</label>
                                    <select wire:model="technician_6_id" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('technician_6_id') border-red-500 @enderror">
                                        <option value="">Nenhum</option>
                                        @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}">{{ $technician->code }} - {{ $technician->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('technician_6_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Horas Tec 6 (minutos)</label>
                                    <input type="number" wire:model="hours_tec_6" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('hours_tec_6') border-red-500 @enderror" min="0">
                                    @error('hours_tec_6') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <!-- Técnico 7 -->
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Técnico 7</label>
                                    <select wire:model="technician_7_id" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('technician_7_id') border-red-500 @enderror">
                                        <option value="">Nenhum</option>
                                        @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}">{{ $technician->code }} - {{ $technician->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('technician_7_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Horas Tec 7 (minutos)</label>
                                    <input type="number" wire:model="hours_tec_7" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('hours_tec_7') border-red-500 @enderror" min="0">
                                    @error('hours_tec_7') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <!-- Técnico 8 -->
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Técnico 8</label>
                                    <select wire:model="technician_8_id" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('technician_8_id') border-red-500 @enderror">
                                        <option value="">Nenhum</option>
                                        @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}">{{ $technician->code }} - {{ $technician->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('technician_8_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Horas Tec 8 (minutos)</label>
                                    <input type="number" wire:model="hours_tec_8" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('hours_tec_8') border-red-500 @enderror" min="0">
                                    @error('hours_tec_8') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <!-- Técnico 9 -->
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Técnico 9</label>
                                    <select wire:model="technician_9_id" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('technician_9_id') border-red-500 @enderror">
                                        <option value="">Nenhum</option>
                                        @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}">{{ $technician->code }} - {{ $technician->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('technician_9_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Horas Tec 9 (minutos)</label>
                                    <input type="number" wire:model="hours_tec_9" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('hours_tec_9') border-red-500 @enderror" min="0">
                                    @error('hours_tec_9') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <!-- Técnico 10 -->
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Técnico 10</label>
                                    <select wire:model="technician_10_id" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('technician_10_id') border-red-500 @enderror">
                                        <option value="">Nenhum</option>
                                        @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}">{{ $technician->code }} - {{ $technician->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('technician_10_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Horas Tec 10 (minutos)</label>
                                    <input type="number" wire:model="hours_tec_10" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('hours_tec_10') border-red-500 @enderror" min="0">
                                    @error('hours_tec_10') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <!-- Estado da Obra -->
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Estado da Obra</label>
                                    <select wire:model="work_state" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('work_state') border-red-500 @enderror" required>
                                        <option value="" disabled>Selecione o estado</option>
                                        <option value="PENDENTE">PENDENTE</option>
                                        <option value="EXECUTADO">EXECUTADO</option>
                                    </select>
                                    @error('work_state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <!-- Localização da Obra -->
                                <div>
                                    <label class="block font-medium mb-2 dark:text-gray-300">Localização da Obra</label>
                                    <select wire:model="location" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:text-gray-300 @error('location') border-red-500 @enderror" required>
                                        <option value="" disabled>Selecione a localização</option>
                                        <option value="INSPECCAO-FINAL">INSPEÇÃO-FINAL</option>
                                        <option value="SUPERVISAO">SUPERVISÃO</option>
                                    </select>
                                    @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="flex justify-end gap-4 mt-4">
                                <button type="button" wire:click="cancelEdit" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600">Cancelar</button>
                                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Salvar</button>
                            </div>
                        </form>
                    </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white  border">
                            <thead>
                                <tr class="bg-gray-200 ">
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
                                    <th class="py-2 px-4 border-b text-left">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($repairOrderDetails as $detail)
                                <tr class="hover:bg-gray-100 ">
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
                                    <td class="py-2 px-4 border-b">
                                        <button wire:click="edit({{ $detail->id }})" class="bg-yellow-500 text-white py-1 px-2 rounded-lg hover:bg-yellow-600">Editar</button>
                                    </td>
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
