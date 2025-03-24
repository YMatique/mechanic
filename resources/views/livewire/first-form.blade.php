<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulário 1') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-3xl font-bold  mb-16 text-center">Formulário de Ordem de Reparação</h1>
                    @if (session()->has('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form class="flex flex-col" wire:submit.prevent="save" name="repair_order_form">
                        <div class="flex flex-1 gap-4">
                            <div class="md:w-1/2 lg:w-1/2 xl:w-1/2 w-full">
                                <!-- Carimbo de Data e Hora -->
                                <div class="mb-4">
                                    <label class="block font-medium mb-3">Carimbo de Data e Hora</label>
                                    <input type="datetime-local" wire:model="stamp" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('stamp') border-red-500 @enderror" required>
                                    @error('stamp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Ordem de Reparação -->
                                <div class="mb-4">
                                    <label class="block font-medium mb-3">Ordem de Reparação</label>
                                    <input type="text" wire:model="repair_order" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('repair_order') border-red-500 @enderror" placeholder="Ex: OR123" required>
                                    @error('repair_order') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Número da Máquina -->
                                <div class="mb-4">
                                    <label class="block font-medium mb-3">Número da Máquina</label>
                                    <input type="text" wire:model="machine_number" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('machine_number') border-red-500 @enderror" placeholder="Ex: M123 ou X-45#" required>
                                    @error('machine_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Mês de Entrada -->
                                <div class="mb-4">
                                    <label class="block font-medium mb-3">Mês de Entrada</label>
                                    <select wire:model="month_entry" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('month_entry') border-red-500 @enderror" required>
                                        <option value="" disabled selected>Selecione o mês</option>
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

                                <!-- Ano -->
                                <div class="mb-4">
                                    <label class="block font-medium mb-3">Ano</label>
                                    <input type="number" wire:model="year_entry" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('year_entry') border-red-500 @enderror" min="2000" max="210言葉" required>
                                    @error('year_entry') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Data de Entrada -->
                                <div class="mb-4">
                                    <label class="block font-medium mb-3">Data de Entrada</label>
                                    <input type="date" wire:model="date_entry" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('date_entry') border-red-500 @enderror" required>
                                    @error('date_entry') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Descrição da Avaria -->
                                <div class="mb-4">
                                    <label class="block font-medium mb-3">Descrição da Avaria</label>
                                    <textarea wire:model="breakdown_description" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('breakdown_description') border-red-500 @enderror" rows="4" placeholder="Descreva o problema..." required></textarea>
                                    @error('breakdown_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="md:w-1/2 lg:w-1/2 xl:w-1/2 w-full">
                                <!-- Tipo de Manutenção -->
                                <div class="mb-4">
                                    <label class="block font-medium mb-3">Tipo de Manutenção a Executar</label>
                                    <select wire:model="mantainance_type" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('mantainance_type') border-red-500 @enderror" required>
                                        <option value="" disabled selected>Selecione o tipo</option>
                                        <option value="CORRECTIVA">CORRECTIVA</option>
                                        <option value="REVISAO">REVISÃO</option>
                                        <option value="REVISAO E INSPEÇÃO GERAL (PLAT)">REVISÃO E INSPEÇÃO GERAL (PLAT)</option>
                                        <option value="INSPEÇÃO GERAL">INSPEÇÃO GERAL</option>
                                        <option value="ACIDENTE">ACIDENTE</option>
                                        <option value="PNEU">PNEU</option>
                                    </select>
                                    @error('mantainance_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Solicitante -->
                                <div class="mb-4">
                                    <label class="block font-medium mb-3">Solicitante</label>
                                    <select wire:model="applicant" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('applicant') border-red-500 @enderror" required>
                                        <option value="" disabled selected>Selecione o solicitante</option>
                                        <option value="PIQUETE (OPEN)">PIQUETE (OPEN)</option>
                                        <option value="PIQUETE (EXECUTADO)">PIQUETE (EXECUTADO)</option>
                                        <option value="INSPEÇÃO">INSPEÇÃO</option>
                                        <option value="SUPERVISÃO">SUPERVISÃO</option>
                                        <option value="NORMAL">NORMAL</option>
                                        <option value="UT-CDM">UT-CDM</option>
                                    </select>
                                    @error('applicant') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Estado da Obra -->
                                <div class="mb-4">
                                    <label class="block font-medium mb-3">Estado da Obra</label>
                                    <select wire:model="work_state" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('work_state') border-red-500 @enderror" required>
                                        <option value="" disabled selected>Selecione o estado</option>
                                        <option value="PENDENTE">PENDENTE</option>
                                        <option value="EXECUTADO">EXECUTADO</option>
                                        <option value="EM EXECUÇÃO">EM EXECUÇÃO</option>
                                        <option value="FECHADO">FECHADO</option>
                                    </select>
                                    @error('work_state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Localização da Obra -->
                                <div class="mb-4">
                                    <label class="block font-medium mb-3">Localização da Obra</label>
                                    <select wire:model="location" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('location') border-red-500 @enderror" required>
                                        <option value="" disabled selected>Selecione a localização</option>
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

                                <!-- Cliente -->
                                <div class="mb-4">
                                    <label class="block font-medium mb-3">Cliente</label>
                                    <select wire:model="cliente" class="w-full p-2 border rounded-lg dark:bg-gray-800 @error('cliente') border-red-500 @enderror" required>
                                        <option value="" disabled selected>Selecione o cliente</option>
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
                        </div>


                        <!-- Botão de Envio -->
                        <div class="text-center">
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
