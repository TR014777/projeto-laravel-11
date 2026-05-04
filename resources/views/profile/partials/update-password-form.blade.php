<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Atualizar Senha') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Certifique-se de que sua conta esteja usando uma senha longa e aleatória para manter-se seguro.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label class="text-zinc-400 text-xs ml-1 mb-1" for="update_password_current_password" :value="__('Senha Atual')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label class="text-zinc-400 text-xs ml-1 mb-1" for="update_password_password" :value="__('Nova Senha')" />
            <x-text-input id="update_password_password" name="password" type="password" class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label class="text-zinc-400 text-xs ml-1 mb-1" for="update_password_password_confirmation" :value="__('Confirmar Senha')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Salvo') }}</p>
            @endif
        </div>
    </form>
</section>
