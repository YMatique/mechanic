<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulário 3') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- resources/views/livewire/repair-order-invoice-form.blade.php -->

                <div class=" p-6 rounded-lg  w-full max-w-4xl mx-auto">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Formulário de Faturação da Ordem de Reparação</h1>

                    @if (session()->has('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form wire:submit.prevent="save" class="flex flex-col gap-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium mb-2">Carimbo de Data e Hora</label>
                                <input type="datetime-local" wire:model="stamp" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('stamp') border-red-500 @enderror" required>
                                @error('stamp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block font-medium mb-2">Ordem de Reparação</label>
                                <input type="text" wire:model="repair_order" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('repair_order') border-red-500 @enderror" placeholder="Ex: OR123" required>
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
                                <input type="text" wire:model="accounting_status" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('accounting_status') border-red-500 @enderror" placeholder="Status da contabilidade" required>
                                @error('accounting_status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="text-center mt-6">
                            <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700">
                                Enviar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
