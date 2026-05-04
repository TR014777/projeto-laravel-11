<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Novo Usuário') }}
        </h2>
    </x-slot>
    <!--Vai pegar o formulário para criar um novo usuário-->
    <form action="{{ route('users.store') }}" method="POST">
        @include('admin.users.partials.form')
    </form>
</x-app-layout>