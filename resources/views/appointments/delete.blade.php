<!--Form para deletar um agendamento-->
<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Deletar Agendamento
            </h2>
        </div>
    </header>
    <div class="py-12">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="p-4 mb-12 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="mb-6 text-gray-900 dark:text-gray-100">Tem certeza que deseja deletar o agendamento do "{{ $appointment->client }}"?</h3>
                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <div class="flex justify-end space-x-2">
                        <x-secondary-button class="ms-2">
                            <a href="{{ route('appointments.index') }}">{{ __('Não') }}</a>
                        </x-secondary-button>
                        <x-danger-button type="submit" class="ms-2">
                            {{ __('Sim') }}
                        </x-danger-button>
                    </div>

                </form>        
            </div>
        </div>
    </div>
</x-app-layout>
