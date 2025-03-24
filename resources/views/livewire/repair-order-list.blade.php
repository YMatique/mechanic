<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ordem de Reparação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- resources/views/livewire/repair-order-list.blade.php -->

                <!-- resources/views/livewire/repair-order-list.blade.php -->

                <div class=" rounded-lg  w-full max-w-6xl mx-auto">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Lista de Ordens de Reparação</h1>

                    @if (session()->has('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Campo de Busca e Botão de Exportar -->
                    <div class="flex justify-between mb-4">
                        <input type="text" wire:model.debounce.500ms="search" class="w-3/4 p-2 border rounded-lg dark:bg-gray-800" placeholder="Pesquisar por Ordem, Máquina ou Descrição...">
                        <button wire:click="export" class="bg-green-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-700">
                            Exportar CSV
                        </button>
                    </div>

                    <!-- Formulário de Edição (exibido quando $editing é true) -->
                    @if ($editing)
                    <div class="mb-6 p-4 border rounded-lg bg-gray-50 dark:bg-gray-700">
                        <h2 class="text-xl font-semibold mb-4">Editar Ordem de Reparação</h2>
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
                                    <label class="block font-medium mb-2">Número da Máquina</label>
                                    <input type="text" wire:model="machine_number" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('machine_number') border-red-500 @enderror" required>
                                    @error('machine_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Mês de Entrada</label>
                                    <select wire:model="month_entry" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('month_entry') border-red-500 @enderror" required>
                                        <option value="" disabled>Selecione o mês</option>
                                        <option value="JAN">JAN</option>
                                        <option value="FEV">FEV</option>
                                        <option value="MAR">MAR</option>
                                        <option value="ABR">ABR</option>
                                        <option value="MAI">MAI</option>
                                        <option value="JUN">JUN</option>
                                        <option value="JUL">JUL</option>
                                        <option value="AGO">AGO</option>
                                        <option value="SET">SET</option>
                                        <option value="OUT">OUT</option>
                                        <option value="NOV">NOV</option>
                                        <option value="DEZ">DEZ</option>
                                    </select>
                                    @error('month_entry') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Ano</label>
                                    <input type="number" wire:model="year_entry" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('year_entry') border-red-500 @enderror" min="2000" max="2100" required>
                                    @error('year_entry') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Data de Entrada</label>
                                    <input type="date" wire:model="date_entry" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('date_entry') border-red-500 @enderror" required>
                                    @error('date_entry') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-span-2">
                                    <label class="block font-medium mb-2">Descrição da Avaria</label>
                                    <textarea wire:model="breakdown_description" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('breakdown_description') border-red-500 @enderror" rows="3" required></textarea>
                                    @error('breakdown_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Tipo de Manutenção</label>
                                    <select wire:model="mantainance_type" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('mantainance_type') border-red-500 @enderror" required>
                                        <option value="" disabled>Selecione o tipo</option>
                                        <option value="CORRECTIVA">CORRECTIVA</option>
                                        <option value="REVISAO">REVISÃO</option>
                                        <option value="REVISAO E INSPEÇÃO GERAL (PLAT)">REVISÃO E INSPEÇÃO GERAL (PLAT)</option>
                                        <option value="INSPEÇÃO GERAL">INSPEÇÃO GERAL</option>
                                        <option value="ACIDENTE">ACIDENTE</option>
                                        <option value="PNEU">PNEU</option>
                                    </select>
                                    @error('mantainance_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Solicitante</label>
                                    <select wire:model="applicant" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('applicant') border-red-500 @enderror" required>
                                        <option value="" disabled>Selecione o solicitante</option>
                                        <option value="PIQUETE (OPEN)">PIQUETE (OPEN)</option>
                                        <option value="PIQUETE (EXECUTADO)">PIQUETE (EXECUTADO)</option>
                                        <option value="INSPEÇÃO">INSPEÇÃO</option>
                                        <option value="SUPERVISÃO">SUPERVISÃO</option>
                                        <option value="NORMAL">NORMAL</option>
                                        <option value="UT-CDM">UT-CDM</option>
                                    </select>
                                    @error('applicant') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Estado da Obra</label>
                                    <select wire:model="work_state" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('work_state') border-red-500 @enderror" required>
                                        <option value="" disabled>Selecione o estado</option>
                                        <option value="PENDENTE">PENDENTE</option>
                                        <option value="EXECUTADO">EXECUTADO</option>
                                        <option value="EM EXECUÇÃO">EM EXECUÇÃO</option>
                                        <option value="FECHADO">FECHADO</option>
                                    </select>
                                    @error('work_state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Localização da Obra</label>
                                    <select wire:model="location" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('location') border-red-500 @enderror" required>
                                        <option value="" disabled>Selecione a localização</option>
                                        <option value="INSPEÇÃO-INICIAL">INSPEÇÃO-INICIAL</option>
                                        <option value="SUPERVISÃO (ELECT)">SUPERVISÃO (ELECT)</option>
                                        <option value="SUPERVISÃO (MEC)">SUPERVISÃO (MEC)</option>
                                        <option value="SUPERVISÃO (SER)">SUPERVISÃO (SER)</option>
                                        <option value="OFICINA">OFICINA</option>
                                        <option value="INSPEÇÃO-FINAL">INSPEÇÃO-FINAL</option>
                                        <option value="FACT.-DANMO">FACT.-DANMO</option>
                                    </select>
                                    @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Cliente</label>
                                    <select wire:model="cliente" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('cliente') border-red-500 @enderror" required>
                                        <option value="" disabled>Selecione o cliente</option>
                                        <option value="CORNELDER">CORNELDER</option>
                                        <option value="CCIS">CCIS</option>
                                        <option value="MTM">MTM</option>
                                        <option value="ACCESS WORLD">ACCESS WORLD</option>
                                        <option value="STEINWEG BRIDGE">STEINWEG BRIDGE</option>
                                        <option value="INTERNO">INTERNO</option>
                                        <option value="OTHER">OTHER</option>
                                    </select>
                                    @error('cliente') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Carimbo</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Ordem de Reparação</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Nº da Máquina</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Mês/Ano</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Data de Entrada</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Descrição da Avaria</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Tipo de Manutenção</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Solicitante</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Estado</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Localização</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Cliente</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($repairOrders as $order)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300"> @php
                                        \Carbon\Carbon::setLocale('pt_BR');
                                        $formattedDate = \Carbon\Carbon::parse($order->stamp)->translatedFormat('d M, Y');
                                        @endphp
                                        {{ $formattedDate }}</td>
                                    <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->repair_order }}</td>
                                    <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->machine_number }}</td>
                                    <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->month_entry }}/{{ $order->year_entry }}</td>
                                    <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">@php
                                        \Carbon\Carbon::setLocale('pt_BR');
                                        $formattedDate = \Carbon\Carbon::parse($order->date_entry)->translatedFormat('d M, Y');
                                        @endphp
                                        {{ $formattedDate }}</td>
                                    <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ Str::limit($order->breakdown_description, 50) }}</td>
                                    <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->mantainance_type }}</td>
                                    <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->applicant }}</td>
                                    <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->work_state }}</td>
                                    <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->location }}</td>
                                    <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->cliente }}</td>
                                    <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">
                                        <button wire:click="edit({{ $order->id }})" class="bg-yellow-500 text-white py-1 px-2 rounded-lg hover:bg-yellow-600">Editar</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12" class="py-2 px-4 text-center text-gray-500 dark:text-gray-400">Nenhum registro encontrado.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginação -->
                    <div class="mt-4">
                        {{ $repairOrders->links() }}
                    </div>
                </div>
                {{-- <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-6xl mx-auto">
                    <h1 class="text-2xl font-bold  mb-6 text-center">Lista de Ordens de Reparação</h1>

                    <!-- Campo de Busca -->
                    <div class="mb-4">
                        <input type="text" wire:model.debounce.500ms="search" class="w-full p-2 border rounded-lg dark:bg-gray-800" placeholder="Pesquisar por Ordem, Máquina ou Descrição...">
                    </div>

                    <!-- Tabela -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800 border">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Carimbo</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Ordem de Reparação</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Nº da Máquina</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Mês/Ano</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Data de Entrada</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Descrição da Avaria</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Tipo de Manutenção</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Solicitante</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Estado</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Localização</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-600 dark:text-gray-200">Cliente</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($repairOrders as $order)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">
                                        @php
                                        \Carbon\Carbon::setLocale('pt_BR');
                                        $formattedDate = \Carbon\Carbon::parse($order->stamp)->translatedFormat('d M, Y');
                                        @endphp
                                        {{ $formattedDate }}
                </td>
                <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->repair_order }}</td>
                <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->machine_number }}</td>
                <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->month_entry }}/{{ $order->year_entry }}</td>
                <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">
                    @php
                    \Carbon\Carbon::setLocale('pt_BR');
                    $formattedDate = \Carbon\Carbon::parse($order->date_entry)->translatedFormat('d M, Y');
                    @endphp
                    {{ $formattedDate }}
                </td>
                <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ Str::limit($order->breakdown_description, 50) }}</td>
                <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->mantainance_type }}</td>
                <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->applicant }}</td>
                <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->work_state }}</td>
                <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->location }}</td>
                <td class="py-2 px-4 border-b text-gray-700 dark:text-gray-300">{{ $order->cliente }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="py-2 px-4 text-center text-gray-500 dark:text-gray-400">Nenhum registro encontrado.</td>
                </tr>
                @endforelse
                </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <div class="mt-4">
                {{ $repairOrders->links() }}
            </div>
        </div> --}}
    </div>
</div>
</div>
</div>
