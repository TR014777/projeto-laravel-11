<x-app-layout>
    <!--Script do chart.js-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <x-slot name="header">
        @include('partials.breadcrumb')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!--Mensagem de bem vindo-->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <span class="dark:text-white">
                    Olá, <strong>{{ Auth::user()->name }}</strong>! 
                    @if(Auth::user()->is_admin)
                        <span class="ml-2 text-xs bg-red-100 text-red-600 px-2 py-1 rounded">Modo Administrador</span>
                    @endif
                </span>
            </div>

            <!--Meus números-->
            <h3 class="text-lg font-bold dark:text-white border-l-4 border-indigo-500 pl-2">
                Minhas Estatísticas
            </h3>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-b-4 border-indigo-500 text-center">
                    <p class="text-xs text-gray-500 uppercase">Total Geral</p>
                    <p class="text-3xl font-black dark:text-white">{{ $statsAppo['total'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-b-4 border-yellow-500 text-center">
                    <p class="text-xs text-gray-500 uppercase">Hoje</p>
                    <p class="text-3xl font-black dark:text-white">{{ $statsAppo['hoje'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-b-4 border-green-500 text-center">
                    <p class="text-xs text-gray-500 uppercase">Concluídos</p>
                    <p class="text-3xl font-black dark:text-white">{{ $statsAppo['concluidos'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-b-4 border-red-500 text-center">
                    <p class="text-xs text-red-600 uppercase">Cancelados</p>
                    <p class="text-3xl font-black dark:text-white">{{ $statsAppo['cancelados'] }}</p>
                </div>
            </div>

            <!--Gráficos locais -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                    <h3 class="text-sm font-bold mb-4 dark:text-white uppercase tracking-wider italic text-indigo-500">
                        Minha Demanda Semanal (%)
                    </h3>
                    <div class="relative h-64 w-full">
                        <canvas id="chartDemandaLocal"></canvas>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                    <h3 class="text-sm font-bold mb-4 dark:text-white uppercase tracking-wider italic text-green-500">
                        Meus Horários de Pico (Qtd)
                    </h3>
                    <div class="relative h-64 w-full">
                        <canvas id="chartHorariosLocal"></canvas>
                    </div>
                </div>
            </div>

            <!--Fila e agenda de Hoje -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!--Próximo atendimento -->
                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                    <h3 class="text-md font-bold mb-4 dark:text-white uppercase tracking-wider">Próximo na Fila</h3>
                    @if($statsAppo['proximoAtendimento'])
                        <a href="{{ route('appointments.show', $statsAppo['proximoAtendimento']->id) }}" class="block hover:scale-[1.01] transition-transform">
                            <div class="p-6 border dark:border-gray-700 rounded-lg border-l-4" style="border-left-color: {{ $statsAppo['proximoAtendimento']->color }}">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-xl font-bold" style="color: {{ $statsAppo['proximoAtendimento']->color }}">
                                            {{ $statsAppo['proximoAtendimento']->client }}
                                        </p>
                                        <p class="text-sm dark:text-gray-400">
                                            {{ date('d/m', strtotime($statsAppo['proximoAtendimento']->date)) }} | 
                                            {{ date('H:i', strtotime($statsAppo['proximoAtendimento']->start)) }} às {{ date('H:i', strtotime($statsAppo['proximoAtendimento']->end)) }}
                                        </p>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </div>
                            </div>
                        </a>
                    @else
                        <p class="text-gray-500 italic text-sm">Nada pendente por agora.</p>
                    @endif
                </div>

                <!--Agenda de hoje -->
                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                    <h3 class="text-md font-bold mb-4 dark:text-white uppercase tracking-wider italic">Agenda de Hoje</h3>
                    <div class="pr-2">
                        @forelse($statsAppo['hojeLista'] as $agenda)
                            <a href="{{ route('appointments.show', $agenda->id) }}" class="block hover:scale-[1.01] transition-transform mb-2">
                                <div class="p-2 border dark:border-gray-700 rounded-lg border-l-4" style="border-left-color: {{ $agenda->color }}">
                                    <div class="flex justify-between items-center">
                                        <p class="font-bold text-sm dark:text-white" style="color: {{ $agenda->color }};">{{ $agenda->client }}</p>
                                        <p class="text-xs text-gray-500">{{ date('H:i', strtotime($agenda->start)) }}</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-8 bg-gray-50 dark:bg-gray-900/50 rounded-lg border-2 border-dashed border-gray-200 dark:border-gray-700">
                                <p class="text-sm text-gray-500 italic">Nenhum agendamento para hoje.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!--Tabela Recente-->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-bold dark:text-white mb-4 italic text-gray-400">Histórico Recente</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-4 py-3">Data</th>
                                <th class="px-4 py-3">Cliente</th>
                                <th class="px-4 py-3 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y dark:divide-gray-700">
                            @foreach($statsAppo['historicoPaginado'] as $appo)
                            <tr class="text-gray-600 dark:text-gray-300">
                                <td class="px-4 py-3">{{ date('d/m', strtotime($appo->date)) }}</td>
                                <td class="px-4 py-3 font-semibold text-indigo-500" style="color: {{ $appo->color }}">{{ $appo->client }}</td>
                                <td class="px-4 py-3 text-right text-[10px] font-bold">
                                    <span class="px-2 py-1 rounded-full {{ $appo->status == 1 ? 'bg-green-100 text-green-700' : ($appo->status == -1 ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700') }}">
                                        {{ $appo->status == 1 ? 'CONCLUÍDO' : ($appo->status == -1 ? 'CANCELADO' : 'AGENDADO') }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $statsAppo['historicoPaginado']->links() }}</div>
            </div>

            <!--Seção global (apenas admin)-->
            @if(Auth::user()->is_admin)
                <div class="pt-8 border-t-2 border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-bold dark:text-white mb-6 flex items-center">
                        <span class="bg-red-500 w-2 h-6 mr-2"></span> Monitoramento Global do Sistema
                    </h3>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <!--Gráfico demanda global-->
                        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                            <h3 class="text-sm font-bold mb-4 dark:text-white uppercase tracking-wider text-red-500">Demanda Global (%)</h3>
                            <div class="relative h-64 w-full">
                                <canvas id="chartDemandaGlobal"></canvas>
                            </div>
                        </div>

                        <!--Gráfico picos globais-->
                        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                            <h3 class="text-sm font-bold mb-4 dark:text-white uppercase tracking-wider text-red-500">Picos Globais (Qtd)</h3>
                            <div class="relative h-64 w-full">
                                <canvas id="chartHorariosGlobal"></canvas>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <!--Os ultimos 5 cadastrados-->
                            <div class="flex justify-between items-center mb-4 p-6 text-gray-900 dark:text-gray-100">
                                <h3 class="text-lg font-bold">Últimos Usuários Cadastrados</h3>
                                <a href="{{ route('users.index') }}" class="text-sm text-indigo-500 hover:underline font-bold">Ver todos →</a>
                            </div>
                            <table class="w-full text-left text-sm">
                                <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-gray-500">
                                    <tr>
                                        <th class="px-4 py-3">ID</th>
                                        <th class="px-4 py-3">Nome</th>
                                        <th class="px-4 py-3">Email</th>
                                        <th class="px-4 py-3 text-right">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y dark:divide-gray-700">
                                    @foreach($allUsers as $user)
                                        <tr class="text-gray-600 dark:text-gray-300">
                                            <td class="px-4 py-3 text-xs">{{ $user->id }}</td>
                                            <td class="px-4 py-3 font-semibold dark:text-gray-200">{{ $user->name }}</td>
                                            <td class="px-4 py-3 text-xs">{{ $user->email }}</td>
                                            <td class="px-4 py-3 text-right">
                                                <span class="px-2 py-1 {{ $user->status == 1 ? 'bg-gray-100' : 'bg-gray-400' }} text-gray-700 rounded-full text-[10px] font-bold">
                                                    {{ $user->status == 1 ? 'ATIVO' : 'INATIVO' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!--Usuários-->
                        <div class="lg:col-span-1 bg-white dark:bg-gray-800 shadow rounded-lg p-6 border-2 border-dashed border-red-500/30">
                            <h3 class="text-md font-bold mb-4 dark:text-white uppercase tracking-wider">Usuários do Sistema</h3>
                            <div class="grid grid-cols-3 gap-2 mb-4">
                                <div class="text-center p-2 bg-gray-50 dark:bg-gray-700 rounded">
                                    <p class="text-[10px] uppercase text-gray-400">Total</p>
                                    <p class="text-lg font-bold dark:text-white">{{ $statsUsers['total'] }}</p>
                                </div>
                                <div class="text-center p-2 bg-gray-50 dark:bg-gray-700 rounded">
                                    <p class="text-[10px] uppercase text-gray-400">Ativos</p>
                                    <p class="text-lg font-bold dark:text-white">{{ $statsUsers['ativos'] }}</p>
                                </div>
                                <div class="text-center p-2 bg-gray-50 dark:bg-gray-700 rounded">
                                    <p class="text-[10px] uppercase text-gray-400">Novos</p>
                                    <p class="text-lg font-bold dark:text-white">{{ $statsUsers['recentes'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!--Script de config dos gráficos -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isDarkMode = document.documentElement.classList.contains('dark');
            const textColor = isDarkMode ? '#9ca3af' : '#6b7280';
            const gridColor = isDarkMode ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

            //Função para criar gráficos
            function createChart(id, type, labels, data, labelName, color) {
                const ctx = document.getElementById(id);
                if(!ctx) return;
                
                return new Chart(ctx.getContext('2d'), {
                    type: type,
                    data: {
                        labels: labels,
                        datasets: [{
                            label: labelName,
                            data: data,
                            backgroundColor: color + (type === 'bar' ? '0.8)' : '0.1)'),
                            borderColor: color + '1)',
                            fill: type === 'line',
                            borderRadius: 6,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { ticks: { color: textColor }, grid: { display: false } },
                            y: { beginAtZero: true, ticks: { color: textColor }, grid: { color: gridColor } }
                        }
                    }
                });
            }

            //Gráficos locais
            const dadosDemandaLocal = @json($statsAppo['demandaSemanal']);
            createChart('chartDemandaLocal', 'bar', dadosDemandaLocal.map(d => d.dia), dadosDemandaLocal.map(d => d.porcentagem), 'Demanda %', 'rgba(99, 102, 241, ');

            const dadosPicoLocal = @json($statsAppo['picoHorario']);
            createChart('chartHorariosLocal', 'line', dadosPicoLocal.labels, dadosPicoLocal.data, 'Agendamentos', 'rgba(16, 185, 129, ');

            //Gráficos globais para se for admin
            @if(Auth::user()->is_admin)
                const dadosDemandaGlobal = @json($statsGlobal['demandaSemanal']);
                createChart('chartDemandaGlobal', 'bar', dadosDemandaGlobal.map(d => d.dia), dadosDemandaGlobal.map(d => d.porcentagem), 'Demanda %', 'rgba(239, 68, 68, ');

                const dadosPicoGlobal = @json($statsGlobal['picoHorario']);
                createChart('chartHorariosGlobal', 'line', dadosPicoGlobal.labels, dadosPicoGlobal.data, 'Agendamentos', 'rgba(239, 68, 68, ');
            @endif
        });
    </script>
</x-app-layout>