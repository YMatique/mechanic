<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulário 1') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- resources/views/livewire/repair-order-invoice-list.blade.php -->

                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-6xl mx-auto">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Lista de Faturações de Ordens de Reparação</h1>

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
                        <h2 class="text-xl font-semibold mb-4">Editar Faturação da Ordem de Reparação</h2>
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
                                    <label class="block font-medium mb-2">Data de Faturação</label>
                                    <input type="date" wire:model="invoice_date" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('invoice_date') border-red-500 @enderror" required>
                                    @error('invoice_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Horas Faturadas</label>
                                    <input type="number" wire:model="invoiced_hours" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('invoiced_hours') border-red-500 @enderror" min="0" required>
                                    @error('invoiced_hours') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Quantidade de Oxigênio (Kg)</label>
                                    <input type="number" wire:model="qty_oxygen" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('qty_oxygen') border-red-500 @enderror" min="0">
                                    @error('qty_oxygen') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Quantidade de Acetileno (Kg)</label>
                                    <input type="number" wire:model="qty_acetylene" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('qty_acetylene') border-red-500 @enderror" min="0">
                                    @error('qty_acetylene') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Quantidade de Propano (Kg)</label>
                                    <input type="number" wire:model="qty_propane" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('qty_propane') border-red-500 @enderror" min="0">
                                    @error('qty_propane') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Estado da Obra</label>
                                    <input type="text" wire:model="work_state" class="w-full p-2 border rounded-lg dark:bg-gray-800" value="FECHADO" readonly>
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">Localização da Obra</label>
                                    <select wire:model="location" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('location') border-red-500 @enderror" required>
                                        <option value="" disabled>Selecione a localização</option>
                                        <option value="FACT.-DANMO">FACT.-DANMO</option>
                                        <option value="FACT.-CONTABILIDADE">FACT.-CONTABILIDADE</option>
                                    </select>
                                    @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block font-medium mb-2">FACT.-CONTABILIDADE</label>
                                    <input type="text" wire:model="accounting_status" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('accounting_status') border-red-500 @enderror" required>
                                    @error('accounting_status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                                    <th class="py-2 px-4 border-b text-left">Data Faturação</th>
                                    <th class="py-2 px-4 border-b text-left">Horas Faturadas</th>
                                    <th class="py-2 px-4 border-b text-left">Oxigênio (Kg)</th>
                                    <th class="py-2 px-4 border-b text-left">Acetileno (Kg)</th>
                                    <th class="py-2 px-4 border-b text-left">Propano (Kg)</th>
                                    <th class="py-2 px-4 border-b text-left">Estado</th>
                                    <th class="py-2 px-4 border-b text-left">Localização</th>
                                    <th class="py-2 px-4 border-b text-left">Contabilidade</th>
                                    <th class="py-2 px-4 border-b text-left">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($repairOrderInvoices as $invoice)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="py-2 px-4 border-b">{{ $invoice->stamp }}</td>
                                    <td class="py-2 px-4 border-b">{{ $invoice->repair_order }}</td>
                                    <td class="py-2 px-4 border-b">{{ $invoice->invoice_date }}</td>
                                    <td class="py-2 px-4 border-b">{{ $invoice->invoiced_hours }}</td>
                                    <td class="py-2 px-4 border-b">{{ $invoice->qty_oxygen ?? '-' }}</td>
                                    <td class="py-2 px-4 border-b">{{ $invoice->qty_acetylene ?? '-' }}</td>
                                    <td class="py-2 px-4 border-b">{{ $invoice->qty_propane ?? '-' }}</td>
                                    <td class="py-2 px-4 border-b">{{ $invoice->work_state }}</td>
                                    <td class="py-2 px-4 border-b">{{ $invoice->location }}</td>
                                    <td class="py-2 px-4 border-b">{{ $invoice->accounting_status }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <button wire:click="edit({{ $invoice->id }})" class="bg-yellow-500 text-white py-1 px-2 rounded-lg hover:bg-yellow-600">Editar</button>
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
                        {{ $repairOrderInvoices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
