<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Deletar Usuário') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="p-4 mb-12 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="mb-6 text-gray-900 dark:text-gray-100">Tem certeza que deseja deletar o usuário "{{ $user->name }}"?</h3>
                <!--Form para deletar o usuário-->
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <div class="flex justify-end space-x-2">
                        <x-secondary-button class="ms-2">
                            <a href="{{ route('users.index') }}">{{ __('Não') }}</a>
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