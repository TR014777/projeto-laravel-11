<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Essa é uma área segura da aplicação. Por favor, confirme sua senha antes de continuar.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" class="text-zinc-400 text-xs ml-1 mb-1" :value="__('Senha')" />

            <x-text-input id="password" class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirmar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
