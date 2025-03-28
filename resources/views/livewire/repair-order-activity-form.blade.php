<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulário 5') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:text-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- resources/views/livewire/repair-order-activity-form.blade.php -->

                <div class=" w-full p-6  mx-auto">
                    <h1 class="text-2xl font-bold  mb-6 text-center">Formulário de Atividade da Ordem de Reparação</h1>

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
                                <label class="block font-medium mb-2">Número do Equipamento</label>
                                <input type="text" wire:model="equipment_number" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('equipment_number') border-red-500 @enderror" placeholder="Ex: EQP-123" required>
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
