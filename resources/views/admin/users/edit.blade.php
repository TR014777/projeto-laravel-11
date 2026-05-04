<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Usuário') }}
        </h2>
    </x-slot>
    <!--Vai pegar o formulário com as informações do usuário que quer atualizar-->
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @method("PUT")
        @include('admin.users.partials.form')
    </form>   
</x-app-layout>