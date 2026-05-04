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