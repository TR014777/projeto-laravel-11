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