@extends('admin.layouts.app')

@section('title', 'Detalhes')

@section('content')

    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            @include('admin.users.partials.breadcrumb')
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Detalhes
            </h2>
        </div>
    </header>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 mb-12 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <x-alert />
                <div class="max-w">
                    <!--Tabela de informações do usuário-->
                    <div class="mb-6 text-gray-900 dark:text-gray-100"><h2>Informações do Usuário</h2></div>
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">ID: {{ $user->id }}</div>
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nome: {{ $user->name }}</div>
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">Status: {{ $user->status ? 'Ativo' : 'Inativo' }}</div><!--Se o usuário está ativo(logado ou não)-->
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">E-mail: {{ $user->email }} ({{ $user->email_verified_at ? 'Verificado' : 'Não verificado' }})</div> <!--Exibe e-mail e informa se é verificado-->
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">Telefone: {{ $user->phone ? $user->phone : 'Não informado' }}</div> <!--Caso não atualize o telefone, vai continuar como não informado-->
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">Turno: [ {{ $user->start_time }}:00 | {{ $user->end_time }}:00 ]</div>
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">Data de Nascimento: {{ $user->birth_date ? $user->birth_date->format('d/m/Y') : 'Não informada' }}</div>
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">País: {{ $user->country_name ? $user->country_name : 'Não disponível' }}</div>
                    <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">Cidade: {{ $user->city_name ? $user->city_name : 'Não disponível' }}</div>
                    
                    <!--Botões de ações (Voltar, Editar ou Deletar)-->
                    <div class="px-6 py-4 flex justify-end gap-2">
                        <x-secondary-button>
                            <a href="{{ route('users.index') }}">Voltar</a>
                        </x-secondary-button>
                        <x-primary-button>
                            <a href="{{ route('users.edit', $user->id) }}">Editar</a>
                        </x-primary-button>
                        <x-danger-button>
                            <a href="{{ route('users.delete', $user->id) }}">Deletar</a>
                        </x-danger-button>
                    </div>
                </div>

            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <x-alert />
                <div class="max-w">
                    <!--Mais outra tabela contendo outra informações importantes-->
                    <div class="mb-6 text-gray-900 dark:text-gray-100"><h2>Outras Informações</h2></div>
                    <div class="flex flex-row justify-between gap-4">
                        <div class="flex flex-col">
                            <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Criado em: {{ $user->created_at}}
                            </div>
                            <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                <!--A informação do ip vai ficar oculta dentro da tag details-->
                                <details class="inline-flex items-center">
                                    <summary class="cursor-pointer outline-none inline">
                                        IP da criação:
                                    </summary>
                                    <span class="px-1 ml-2 font-normal text-gray-500">
                                        {{ $user->created_ip ? $user->created_ip : 'Não disponível' }}
                                    </span>
                                </details>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Ultimo login: {{ $user->last_login_at ? $user->last_login_at : 'Nunca logado' }}
                            </div>
                            <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                <details class="inline-flex items-center">
                                    <!--Mesma coisa, a informação está dentro da tag details escondida-->
                                    <summary class="cursor-pointer outline-none inline">
                                        IP do ultimo login:
                                    </summary>
                                    <span class="px-1 ml-2 font-normal text-gray-500">
                                        {{ $user->last_login_ip ? $user->last_login_ip : 'Não disponível' }}
                                    </span>
                                </details>
                            </div>
                        </div>
                    </div>
                    <!--Exibe a ultima vez que foi atualizado-->
                    <div class="pt-6 block font-medium text-sm text-gray-700 dark:text-gray-300">Ultima atualização: {{ $user->updated_at ? $user->updated_at : 'Nunca atualizado' }}</div> 
                </div>
            </div>
        </div>
    </div>
    
@endsection