<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes do Agendamento') }}
        </h2>
    </x-slot>

   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 mb-12 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg border-b-4" style="border-color: {{ $appointment->color }};">
                <x-alert />
                <div class="max-w-7xl">
                    <!--Tabela de informações sobre o agendamento-->
                    <div class="mb-6 text-gray-900 dark:text-gray-100"><h2>Agendamento</h2></div>
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">ID: {{ $appointment->id }}</div>
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">Cliente: {{ $appointment->client }}</div>
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">Serviço: {{ $appointment->service ?? 'Não informado' }}</div> 
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                        Status: <!--Vai fazer a checagem do valor e exibir a informação com base no valor-->
                        @if($appointment->status == 0)             
                            Agendado
                        @elseif($appointment->status == 1)
                            Finalizado
                        @else
                            Cancelado
                        @endif
                    </div>
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">Dia e horário agendado: {{ $appointment->date }} [ {{ $appointment->start }} | {{ $appointment->end }} ]</div>
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">Criado em: {{ $appointment->created }}</div>
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">Ultima atualização: {{ $appointment->updated_at ? $appointment->updated_at : 'Nunca atualizado' }}</div> 
                    <!--Botões de ação-->
                    <div class="px-6 py-4 flex justify-end gap-2">
                        <x-secondary-button>
                            <a href="{{ route('appointments.index') }}">{{__('Voltar')}}</a>
                        </x-secondary-button>
                        <!--Condicional para situações onde foi cancelado ou finalizado-->
                        @if($appointment->status == 0)
                            <x-secondary-button>
                                <a href="{{ route('appointments.edit', $appointment->id) }}">{{ __('Editar') }}</a>
                            </x-secondary-button>

                            <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <x-danger-button type="submit">
                                    {{ __('Cancelar') }}
                                </x-danger-button>
                            </form>

                            <form action="{{ route('appointments.finish', $appointment->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <x-primary-button type="submit">
                                    {{ __('Finalizar') }}
                                </x-primary-button>
                            </form>
                        @else
                            <x-danger-button>
                                <a href="{{ route('appointments.delete', $appointment->id) }}">{{__('Deletar')}}</a>
                            </x-danger-button>
                        @endif
                    </div>
                </div>
            </div>
        </div>        
    </div>
</x-app-layout> <!--67-->