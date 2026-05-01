<!--Um form para setar as preferências do turno do usuário-->
<div class="flex flex-row justify-between mb-6 p-4 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border-l-4 border-blue-500">
    <form method="GET" action="{{ url()->current() }}" class="flex flex-wrap items-center gap-4">
        <input type="hidden" name="week" value="{{ request('week', 0) }}">
        <input type="hidden" name="save_preference" value="1">

        <div class="flex items-center gap-2">
            <h3 class="text-base font-medium text-gray-900 dark:text-gray-100">Meu turno</h3>
        </div>

        <!--Pegando o início do turno-->
        <div class="flex items-center gap-2">
            <x-input-label>{{ __('Início:') }}</x-input-label>
            <select name="start_time" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 text-sm">
                @for($i=0; $i<24; $i++)
                    <option value="{{ $i }}" {{ $prefStart == $i ? 'selected' : '' }}>{{ sprintf('%02d:00', $i) }}</option> <!--Um esquema de formatação de texto para o select-->
                @endfor
            </select>
        </div>

        <!--Pegando o fim do turno-->
        <div class="flex items-center gap-2">
            <x-input-label>{{ __('Fim:') }}</x-input-label>
            <select name="end_time" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 text-sm">
                @for($i=0; $i<24; $i++)
                    <option value="{{ $i }}" {{ $prefEnd == $i ? 'selected' : '' }}>{{ sprintf('%02d:00', $i) }}</option> <!--Mesma coisa porém pro final também-->
                @endfor
            </select>
        </div>

        <!--Botão para salvar as preferências-->
        <x-primary-button class="text-xs">
            {{ __('Salvar e Aplicar') }}
        </x-primary-button>

        <!--Botão para limpar os filtros-->
        @if(request()->has('start_time'))
            <a href="{{ request()->url() }}?week={{ $weekOffset }}" class="text-xs text-gray-500 hover:underline">Limpar Filtro</a>
        @endif
    </form>

    <!--Botão específico para criar novos agendamentos-->
    <x-primary-button class="text-sm">
        <a href="{{ route('appointments.create') }}">{{ __('Agendar') }}</a>
    </x-primary-button>
</div>