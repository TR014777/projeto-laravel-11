<!--Chamando o form para atualizar o agendamento-->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Atualizar Agendamento') }}
        </h2>
    </x-slot>
    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
        @method("PUT")
        @include('appointments.partials.form')
    </form>
</x-app-layout>