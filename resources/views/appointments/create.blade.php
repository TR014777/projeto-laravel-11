
<!--Chamando o forms para fazer o novo agendamento-->
<x-app-layout>
    <x-slot name="header">
        @include('appointments.partials.breadcrumb')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Realizar Agendamento') }}
        </h2>
    </x-slot>
    <form action="{{ route('appointments.store') }}" method="POST">
        @include('appointments.partials.form')
    </form>
</x-app-layout>

