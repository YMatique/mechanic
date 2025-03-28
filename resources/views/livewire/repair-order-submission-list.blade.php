<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Submissões de Ordens de Reparação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:text-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" p-6 rounded-lg  w-full  mx-auto">
                    <h1 class="text-2xl font-bold  mb-6 text-center">Lista de Submissões de Ordens de Reparação</h1>

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
                        <h2 class="text-xl font-semibold mb-4">Editar Submissão da Ordem de Reparação</h2>
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
                                    <label class="block font-medium mb-2">Estado da Obra</label>
                                    <select wire:model="work_state" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('work_state') border-red-500 @enderror" required>
                                        <option value="" disabled>Selecione o estado</option>
                                        <option value="PROCESS.-FACT">PROCESS.-FACT</option>
                                        <option value="FECHADO">FECHADO</option>
                                    </select>
                                    @error('work_state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Localização da Obra</label>
                                    <select wire:model="location" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('location') border-red-500 @enderror" required>
                                        <option value="" disabled>Selecione a localização</option>
                                        <option value="FACT.-CDM">FACT.-CDM</option>
                                        <option value="FACT.-DANMO">FACT.-DANMO</option>
                                    </select>
                                    @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Data de Submissão a CdM</label>
                                    <input type="date" wire:model="submission_date" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('submission_date') border-red-500 @enderror" required>
                                    @error('submission_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                                    <th class="py-2 px-4 border-b text-left">Estado</th>
                                    <th class="py-2 px-4 border-b text-left">Localização</th>
                                    <th class="py-2 px-4 border-b text-left">Data Submissão</th>
                                    <th class="py-2 px-4 border-b text-left">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($repairOrderSubmissions as $submission)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="py-2 px-4 border-b">
                                        @php
                                        \Carbon\Carbon::setLocale('pt_BR');
                                        $formattedDate = \Carbon\Carbon::parse($submission->stamp)->translatedFormat('d-m-Y');
                                        @endphp
                                        {{ $formattedDate }}
                                    </td>
                                    <td class="py-2 px-4 border-b">{{ $submission->repair_order }}</td>
                                    <td class="py-2 px-4 border-b">{{ $submission->equipment_number }}</td>
                                    <td class="py-2 px-4 border-b">{{ $submission->work_state }}</td>
                                    <td class="py-2 px-4 border-b">{{ $submission->location }}</td>
                                    <td class="py-2 px-4 border-b">{{ $submission->submission_date->format('d/m/Y') }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <button wire:click="edit({{ $submission->id }})" class="bg-yellow-500 text-white py-1 px-2 rounded-lg hover:bg-yellow-600">Editar</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="py-2 px-4 text-center">Nenhum registro encontrado.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $repairOrderSubmissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
