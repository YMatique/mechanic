<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulário 2') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- resources/views/livewire/repair-order-detail-form.blade.php -->

                <div class=" p-6 rounded-lg w-full max-w-4xl mx-auto">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Formulário de Detalhes da Ordem de Reparação</h1>

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
                                <label class="block font-medium mb-2">Tempo Total (minutos)</label>
                                <input type="number" wire:model="total_time" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('total_time') border-red-500 @enderror" min="0" required>
                                @error('total_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <!-- Técnico 1 -->
                            <div>
                                <label class="block font-medium mb-2">Técnico 1</label>
                                <select wire:model="technician_1_id" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('technician_1_id') border-red-500 @enderror" required>
                                    <option value="" disabled>Selecione o técnico</option>
                                    @foreach ($technicians as $technician)
                                    <option value="{{ $technician->id }}">{{ $technician->code }} - {{ $technician->name }}</option>
                                    @endforeach
                                </select>
                                @error('technician_1_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block font-medium mb-2">Horas Tec 1 (minutos)</label>
                                <input type="number" wire:model="hours_tec_1" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('hours_tec_1') border-red-500 @enderror" min="0" required>
                                @error('hours_tec_1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <!-- Técnico 2 -->
                            <div>
                                <label class="block font-medium mb-2">Técnico 2</label>
                                <select wire:model="technician_2_id" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('technician_2_id') border-red-500 @enderror">
                                    <option value="">Nenhum</option>
                                    @foreach ($technicians as $technician)
                                    <option value="{{ $technician->id }}">{{ $technician->code }} - {{ $technician->name }}</option>
                                    @endforeach
                                </select>
                                @error('technician_2_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block font-medium mb-2">Horas Tec 2 (minutos)</label>
                                <input type="number" wire:model="hours_tec_2" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('hours_tec_2') border-red-500 @enderror" min="0">
                                @error('hours_tec_2') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <!-- Repetir para Técnicos 3 a 10 (exemplo para Técnico 3) -->
                            <div>
                                <label class="block font-medium mb-2">Técnico 3</label>
                                <select wire:model="technician_3_id" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('technician_3_id') border-red-500 @enderror">
                                    <option value="">Nenhum</option>
                                    @foreach ($technicians as $technician)
                                    <option value="{{ $technician->id }}">{{ $technician->code }} - {{ $technician->name }}</option>
                                    @endforeach
                                </select>
                                @error('technician_3_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block font-medium mb-2">Horas Tec 3 (minutos)</label>
                                <input type="number" wire:model="hours_tec_3" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('hours_tec_3') border-red-500 @enderror" min="0">
                                @error('hours_tec_3') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <!-- Adicionar os outros técnicos (4 a 10) de forma semelhante -->
                            <!-- Estado da Obra -->
                            <div>
                                <label class="block font-medium mb-2">Estado da Obra</label>
                                <select wire:model="work_state" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('work_state') border-red-500 @enderror" required>
                                    <option value="" disabled>Selecione o estado</option>
                                    <option value="PENDENTE">PENDENTE</option>
                                    <option value="EXECUTADO">EXECUTADO</option>
                                </select>
                                @error('work_state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <!-- Localização da Obra -->
                            <div>
                                <label class="block font-medium mb-2">Localização da Obra</label>
                                <select wire:model="location" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('location') border-red-500 @enderror" required>
                                    <option value="" disabled>Selecione a localização</option>
                                    <option value="INSPECCAO-FINAL">INSPEÇÃO-FINAL</option>
                                    <option value="SUPERVISAO">SUPERVISÃO</option>
                                </select>
                                @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
