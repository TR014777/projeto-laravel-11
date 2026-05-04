<div class="pt-8 border-t-2 border-gray-200 dark:border-gray-700">
    <h3 class="text-xl font-bold dark:text-white mb-6 flex items-center">
        <span class="bg-red-500 w-2 h-6 mr-2"></span> Monitoramento Global do Sistema
    </h3>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-sm font-bold mb-4 dark:text-white uppercase tracking-wider text-red-500">Demanda Global (%)</h3>
            <div class="relative h-64 w-full">
                <canvas id="chartDemandaGlobal"></canvas>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-sm font-bold mb-4 dark:text-white uppercase tracking-wider text-red-500">Picos Globais (Qtd)</h3>
            <div class="relative h-64 w-full">
                <canvas id="chartHorariosGlobal"></canvas>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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

        <div class="lg:col-span-1 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
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