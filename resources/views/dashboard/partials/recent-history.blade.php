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
                <tr onclick="window.location='{{ route('appointments.show', $appo->id) }}'" class="cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors group text-gray-600 dark:text-gray-300 border-b dark:border-gray-700">
                    <td class="px-4 py-3 text-sm">
                        {{ date('d/m', strtotime($appo->date)) }}
                    </td>
                    <td class="px-4 py-3 font-semibold" style="color: {{ $appo->color }}">
                        {{ $appo->client }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        <span class="inline-block px-2 py-1 rounded-full text-[10px] font-bold {{ $appo->status == 1 ? 'bg-green-100 text-green-700' : ($appo->status == -1 ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700') }}">
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