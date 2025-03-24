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
                    <form class="flex flex-col" name="repair_order_form">
                        <div class="flex flex-1 gap-4">
                            <div class="md:w-1/2 lg:w-1/2 xl:w-1/2 w-full">
                                <!-- Carimbo de Data e Hora -->
                                <div class="mb-4">
                                    <label class="block  font-medium mb-3">Carimbo de Data e Hora</label>
                                    <input type="datetime-local" name="stamp" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:bg-gray-800" required>
                                </div>

                                <!-- Ordem de Reparação -->
                                <div class="mb-4">
                                    <label class="block  font-medium mb-3">Ordem de Reparação</label>
                                    <input type="text" name="repair_order" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:bg-gray-800" placeholder="Ex: OR123" required>
                                </div>

                                <!-- Número da Máquina -->
                                <div class="mb-4">
                                    <label class="block  font-medium mb-3">Número da Máquina</label>
                                    <input type="text" name="machine_number" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:bg-gray-800" placeholder="Ex: M123 ou X-45#" required>
                                </div>

                                <!-- Mês de Entrada -->
                                <div class="mb-4">
                                    <label class="block  font-medium mb-3">Mês de Entrada</label>
                                    <select name="month_entry" class="w-full p-2 border rounded-lg dark:bg-gray-800 dark:bg-gray-800" required>
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
                                </div>

                                <!-- Ano -->
                                <div class="mb-4">
                                    <label class="block  font-medium mb-3">Ano</label>
                                    <input type="number" name="year_entry" class="w-full p-2 border rounded-lg dark:bg-gray-800" min="2000" max="2100" required>
                                </div>

                                <!-- Data de Entrada -->
                                <div class="mb-4">
                                    <label class="block  font-medium mb-3">Data de Entrada</label>
                                    <input type="date" name="date_entry" class="w-full p-2 border rounded-lg dark:bg-gray-800" required>
                                </div>

                                <!-- Descrição da Avaria -->
                                <div class="mb-4">
                                    <label class="block  font-medium mb-3">Descrição da Avaria</label>
                                    <textarea name="breakdown_description" class="w-full p-2 border rounded-lg dark:bg-gray-800" rows="4" placeholder="Descreva o problema..." required></textarea>
                                </div>
                            </div>


                            <div class="md:w-1/2 lg:w-1/2 xl:w-1/2  w-full">


                                <!-- Tipo de Manutenção -->
                                <div class="mb-4">
                                    <label class="block  font-medium mb-3">Tipo de Manutenção a Executar</label>
                                    <select name="mantainance_type" class="w-full p-2 border rounded-lg dark:bg-gray-800" required>
                                        <option value="" disabled selected>Selecione o tipo</option>
                                        <option value="CORRECTIVA">CORRECTIVA</option>
                                        <option value="REVISAO">REVISÃO</option>
                                        <option value="REVISAO E INSPEÇÃO GERAL (PLAT)">REVISÃO E INSPEÇÃO GERAL (PLAT)</option>
                                        <option value="INSPEÇÃO GERAL">INSPEÇÃO GERAL</option>
                                        <option value="ACIDENTE">ACIDENTE</option>
                                        <option value="PNEU">PNEU</option>
                                    </select>
                                </div>

                                <!-- Solicitante -->
                                <div class="mb-4">
                                    <label class="block  font-medium mb-3">Solicitante</label>
                                    <select name="applicant" class="w-full p-2 border rounded-lg dark:bg-gray-800" required>
                                        <option value="" disabled selected>Selecione o solicitante</option>
                                        <option value="PIQUETE (OPEN)">PIQUETE (OPEN)</option>
                                        <option value="PIQUETE (EXECUTADO)">PIQUETE (EXECUTADO)</option>
                                        <option value="INSPEÇÃO">INSPEÇÃO</option>
                                        <option value="SUPERVISÃO">SUPERVISÃO</option>
                                        <option value="NORMAL">NORMAL</option>
                                        <option value="UT-CDM">UT-CDM</option>
                                    </select>
                                </div>

                                <!-- Estado da Obra -->
                                <div class="mb-4">
                                    <label class="block  font-medium mb-3">Estado da Obra</label>
                                    <select name="work_state" class="w-full p-2 border rounded-lg dark:bg-gray-800" required>
                                        <option value="" disabled selected>Selecione o estado</option>
                                        <option value="PENDENTE">PENDENTE</option>
                                        <option value="EXECUTADO">EXECUTADO</option>
                                        <option value="EM EXECUÇÃO">EM EXECUÇÃO</option>
                                        <option value="FECHADO">FECHADO</option>
                                    </select>
                                </div>

                                <!-- Localização da Obra -->
                                <div class="mb-4">
                                    <label class="block  font-medium mb-3">Localização da Obra</label>
                                    <select name="location" class="w-full p-2 border rounded-lg dark:bg-gray-800" required>
                                        <option value="" disabled selected>Selecione a localização</option>
                                        <option value="INSPEÇÃO-INICIAL">INSPEÇÃO-INICIAL</option>
                                        <option value="SUPERVISÃO (ELECT)">SUPERVISÃO (ELECT)</option>
                                        <option value="SUPERVISÃO (MEC)">SUPERVISÃO (MEC)</option>
                                        <option value="SUPERVISÃO (SER)">SUPERVISÃO (SER)</option>
                                        <option value="OFICINA">OFICINA</option>
                                        <option value="INSPEÇÃO-FINAL">INSPEÇÃO-FINAL</option>
                                        <option value="FACT.-DANMO">FACT.-DANMO</option>
                                    </select>
                                </div>

                                <!-- Cliente -->
                                <div class="mb-4">
                                    <label class="block  font-medium mb-3">Cliente</label>
                                    <select name="cliente" class="w-full p-2 border rounded-lg dark:bg-gray-800" required>
                                        <option value="" disabled selected>Selecione o cliente</option>
                                        <option value="CORNELDER">CORNELDER</option>
                                        <option value="CCIS">CCIS</option>
                                        <option value="MTM">MTM</option>
                                        <option value="ACCESS WORLD">ACCESS WORLD</option>
                                        <option value="STEINWEG BRIDGE">STEINWEG BRIDGE</option>
                                        <option value="INTERNO">INTERNO</option>
                                        <option value="OTHER">OTHER</option>
                                    </select>
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
