<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulário 4') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:text-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" p-6 rounded-lg shadow-lg w-full  mx-auto">
                    <h1 class="text-2xl font-bold mb-6 text-center">Formulário de Submissão da Ordem de Reparação</h1>

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
