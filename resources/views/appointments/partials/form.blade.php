<!--Form simples para criar e atualizar os agendamentos-->
<div class="mt-6 space-y-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <x-alert />
    @csrf()

    <!-- Nome -->
    <div class="mb-5">
        <x-input-label for="client" :value="__('Nome')" />
        <x-text-input id="client" name="client" type="text" class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm" 
            :value="old('client', $appointment->client ?? '')" required autofocus />
    </div>

    <!-- Serviço -->
    <div class="mb-5">
        <x-input-label for="service" :value="__('Serviço')" />
        <x-text-input id="service" name="service" type="text" class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm" 
            :value="old('service', $appointment->service ?? '')" autofocus />
    </div>

    <!-- Agendamento -->
    <div class="flex flex-row gap-4">
        <!-- Data -->
        <div class="mb-5">
            <x-input-label for="date" :value="__('Data')" />
            <input type="date" id="date" name="date" 
                class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm" 
                value="{{ old('date', (isset($appointment) && $appointment->date) ? date('Y-m-d', strtotime($appointment->date)) : '') }}" />
        </div>

        @php
            $user = auth()->user();

            $inicioTurno = $user->start_time ?? 8; 
            $fimTurno = $user->end_time ?? 18;
        @endphp

        <!-- Horário de Início -->
        <div class="mb-5">
            <x-input-label for="start" :value="__('Horário de Início')" />
            <select id="start" name="start" class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm">
                {{-- Opção Neutra --}}
                <option value="">--:--</option>
                
                @for ($hora = $inicioTurno; $hora <= $fimTurno; $hora++)
                    @for ($minuto = 0; $minuto < 60; $minuto += 5)
                        @php
                            $h = sprintf('%02d:%02d', $hora, $minuto);
                            $valorBanco = isset($appointment) ? substr($appointment->start, 11, 5) : '';
                        @endphp
                        <option value="{{ $h }}" {{ old('start') == $h ? 'selected' : '' }}>
                            {{ $h }}
                        </option>
                        @if($hora == $fimTurno) @break @endif 
                    @endfor
                @endfor
            </select>
        </div>

        <!-- Horário de Fim -->
        <div class="mb-5">
            <x-input-label for="end" :value="__('Horário de Término')" />
            <select id="end" name="end" class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm">
                <option value="">--:--</option>
                
                @for ($hora = $inicioTurno; $hora <= $fimTurno; $hora++)
                    @for ($minuto = 0; $minuto < 60; $minuto += 5)
                        @php
                            $h = sprintf('%02d:%02d', $hora, $minuto);
                            $valorBancoEnd = isset($appointment) ? substr($appointment->end, 11, 5) : '';
                        @endphp
                        <option value="{{ $h }}" {{ old('end') == $h ? 'selected' : '' }}>
                            {{ $h }}
                        </option>
                        @if($hora == $fimTurno) @break @endif
                    @endfor
                @endfor
            </select>
        </div>

        <!-- Cor -->
        <div class="mb-5">
            <x-input-label for="color" :value="__('Cor')" />
            <input type="color" id="color" name="color" 
                class="h-10 w-20 block bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md shadow-sm" 
                value="{{ old('color', $appointment->color ?? '#2563eb') }}" />
        </div>
    </div>

    <!-- Botões -->
    <div class="flex flex-row justify-end gap-4">
        <x-secondary-button type="button" onclick="window.location='{{ route('appointments.index') }}'">
            {{ __('Voltar') }}
        </x-secondary-button>
        <x-primary-button type="submit">
            {{ __('Salvar Agendamento') }}
        </x-primary-button>
    </div>
</div>