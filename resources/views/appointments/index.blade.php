<!--Tabela dos agendamentos-->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agendamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @include('appointments.partials.preferences')

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden p-6">
                
                {{--Navegação da Semana--}}
                <div class="px-6 py-4 bg-gray-800 mb-4 rounded-lg flex justify-between items-center text-white">
                    <div class="flex space-x-2">
                        <!--Fazer uma checagem para ver se ta na semana atual-->
                        @if($weekOffset > 0)
                            <a href="{{ request()->fullUrlWithQuery(['week' => $weekOffset - 1]) }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-md text-sm font-bold">&larr; Anterior</a>
                            <a href="{{ request()->fullUrlWithQuery(['week' => 0]) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 rounded-md text-sm">Hoje</a>
                        @else
                            <div class="px-4 py-2 bg-gray-700/20 text-gray-500 rounded-md text-sm italic">Semana Atual</div>
                        @endif
                    </div>
                    <h2 class="text-xl font-bold">{{ $dias[0]['dia_mes'] }} - {{ $dias[6]['dia_mes'] }}</h2>
                    <a href="{{ request()->fullUrlWithQuery(['week' => $weekOffset + 1]) }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-md text-sm font-bold">Próxima &rarr;</a>
                </div>

                <div class="overflow-x-auto shadow-md sm:rounded-lg border dark:border-gray-700">
                    <table class="w-full text-sm text-left border-collapse">
                        <thead class="text-xs uppercase bg-gray-200 dark:bg-gray-900 text-gray-900 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-4 border-b dark:border-gray-600 w-32 text-center">Horário</th>
                                <!--Fazendo o thead dos dias-->
                                @foreach($dias as $dia)
                                    <th class="px-6 py-4 border-b dark:border-gray-600 text-center">
                                        <span class="block font-bold text-base">{{ $dia['label'] }}</span>
                                        <span class="text-[10px] font-normal opacity-70">{{ $dia['dia_mes'] }}</span>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <!--Criando as linhas-->
                            @forelse($horarios as $hora)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" style="height: 10rem;">
                                    <td class="font-bold border-r dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-center text-gray-700 dark:text-gray-300">
                                        {{ $hora }}
                                    </td>
                                    @foreach($dias as $dia)
                                        <td class="relative p-0 border-r dark:border-gray-700 bg-gray-50/30">
                                            @foreach($appointments->where('date', $dia['data_banco']) as $ag)
                                                @if(date('H:00', strtotime($ag->start)) === $hora)
                                                    <!--Vai chamar o componente que cria o card do agendamento e deixa marcado no horário-->
                                                    <x-appointment-card :appointment="$ag" />
                                                @endif
                                            @endforeach
                                        </td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr><td colspan="8" class="p-10 text-center italic text-gray-500">Nenhum horário configurado.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>