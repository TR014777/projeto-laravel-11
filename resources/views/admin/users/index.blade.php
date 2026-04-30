@extends('admin.layouts.app')

@section('title', 'Usuários')

@section('content')
    
    <div class="mb-4">
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"> 
                @include('admin.users.partials.breadcrumb')
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">       
                    Usuários
                </h2>
            </div>
        </header>
    </div>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex-col space-y-4">
            <x-alert />
            <div class="flex justify-end">
                <x-primary-button class="mb-4">
                    <a href="{{ route('users.create') }}">Novo Usuário </a>
                </x-primary-button>
            </div>
        </div>


        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-4">Nome</th>
                    <th scope="col" class="px-6 py-4">E-mail</th>
                    <th scope="col" class="px-6 py-4 flex justify-end">Ações</th>
                </tr>
            </thead>


            <tbody class="text-gray-600 text-sm font-light">
                @forelse ($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4 flex justify-end gap-2">
                            <x-primary-button>
                                <a href="{{ route('users.show', $user->id) }}">Visualizar</a>
                            </x-primary-button>
                            <x-secondary-button>
                                <a href="{{ route('users.edit', $user->id) }}">Editar</a>
                            </x-secondary-button>
                            <x-danger-button>
                                <a href="{{ route('users.delete', $user->id) }}">Deletar</a>
                            </x-danger-button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100">Nenhum usuário no banco</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="py-4 flex justify-center">
        {{ $users->links() }}
    </div>
@endsection