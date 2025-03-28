<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Actividades de Ordens de Reparação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:text-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- resources/views/livewire/repair-order-activity-list.blade.php -->

                <div class=" p-6  w-full mx-auto">
                    <h1 class="text-2xl font-bold  mb-6 text-center">Lista de Atividades de Ordens de Reparação</h1>

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
                    <div class="mb-6 p-4 border rounded-lg bg-gray-50 dark:bg-gray-700">
                        <h2 class="text-xl font-semibold mb-4">Editar Atividade da Ordem de Reparação</h2>
                        <form wire:submit.prevent="update" class="flex flex-col gap-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-medium mb-2">Carimbo de Data e Hora</label>
                                    <input type="datetime-local" wire:model="stamp" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('stamp') border-red-500 @enderror" required>
                                    @error('stamp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Ordem de Reparação</label>
                                    <input type="text" wire:model="repair_order" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('repair_order') border-red-500 @enderror" required>
                                    @error('repair_order') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Número do Equipamento</label>
                                    <input type="text" wire:model="equipment_number" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('equipment_number') border-red-500 @enderror" required>
                                    @error('equipment_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Código do Colaborador</label>
                                    <select wire:model="technician_id" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('technician_id') border-red-500 @enderror" required>
                                        <option value="" disabled>Selecione o colaborador</option>
                                        @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}">{{ $technician->code }} - {{ $technician->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('technician_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">01. Data de Realização</label>
                                    <input type="date" wire:model="execution_date_1" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('execution_date_1') border-red-500 @enderror" required>
                                    @error('execution_date_1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Horas Faturadas (1)</label>
                                    <input type="number" wire:model="invoiced_hours_1" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('invoiced_hours_1') border-red-500 @enderror" min="0" required>
                                    @error('invoiced_hours_1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">02. Data de Realização (Opcional)</label>
                                    <input type="date" wire:model="execution_date_2" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('execution_date_2') border-red-500 @enderror">
                                    @error('execution_date_2') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Horas Faturadas (2) (Opcional)</label>
                                    <input type="number" wire:model="invoiced_hours_2" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('invoiced_hours_2') border-red-500 @enderror" min="0">
                                    @error('invoiced_hours_2') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block font-medium mb-2">Descrição da Atividade</label>
                                    <textarea wire:model="activity_description" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('activity_description') border-red-500 @enderror" rows="3" required></textarea>
                                    @error('activity_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Cliente</label>
                                    <select wire:model="client" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('client') border-red-500 @enderror" required>
                                        <option value="" disabled>Selecione o cliente</option>
                                        <option value="CORNELDER">CORNELDER</option>
                                        <option value="CCIS">CCIS</option>
                                        <option value="MTM">MTM</option>
                                        <option value="ACCESS WORLD">ACCESS WORLD</option>
                                        <option value="OTHER">OTHER</option>
                                    </select>
                                    @error('client') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="flex justify-end gap-4 mt-4">
                                <button type="button" wire:click="cancelEdit" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600">Cancelar</button>
                                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Salvar</button>
                            </div>
                        </form>
                    </div>
                    @endif

                    <!-- Tabela -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800 border">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="py-2 px-4 border-b text-left">Carimbo</th>
                                    <th class="py-2 px-4 border-b text-left">Ordem de Reparação</th>
                                    <th class="py-2 px-4 border-b text-left">Nº Equipamento</th>
                                    <th class="py-2 px-4 border-b text-left">Colaborador</th>
                                    <th class="py-2 px-4 border-b text-left">Data 1</th>
                                    <th class="py-2 px-4 border-b text-left">Horas 1</th>
                                    <th class="py-2 px-4 border-b text-left">Data 2</th>
                                    <th class="py-2 px-4 border-b text-left">Horas 2</th>
                                    <th class="py-2 px-4 border-b text-left">Descrição</th>
                                    <th class="py-2 px-4 border-b text-left">Cliente</th>
                                    <th class="py-2 px-4 border-b text-left">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($repairOrderActivities as $activity)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="py-2 px-4 border-b">{{ $activity->stamp}}</td>
                                    <td class="py-2 px-4 border-b">{{ $activity->repair_order }}</td>
                                    <td class="py-2 px-4 border-b">{{ $activity->equipment_number }}</td>
                                    <td class="py-2 px-4 border-b">{{ $activity->technician->code }}</td>
                                    <td class="py-2 px-4 border-b">{{ $activity->execution_date_1->format('d/m/Y') }}</td>
                                    <td class="py-2 px-4 border-b">{{ $activity->invoiced_hours_1 }}</td>
                                    <td class="py-2 px-4 border-b">{{ $activity->execution_date_2 ? $activity->execution_date_2->format('d/m/Y') : '-' }}</td>
                                    <td class="py-2 px-4 border-b">{{ $activity->invoiced_hours_2 ?? '-' }}</td>
                                    <td class="py-2 px-4 border-b">{{ $activity->activity_description }}</td>
                                    <td class="py-2 px-4 border-b">{{ $activity->client }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <button wire:click="edit({{ $activity->id }})" class="bg-yellow-500 text-white py-1 px-2 rounded-lg hover:bg-yellow-600">Editar</button>
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
                        {{ $repairOrderActivities->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
