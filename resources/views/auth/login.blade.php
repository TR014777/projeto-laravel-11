<x-guest-layout>
    <div class="mb-6 text-center md:text-left">
        <h2 class="text-2xl font-bold text-white tracking-tight">Login</h2>
        <p class="text-zinc-400 text-xs mt-1">Acesse sua conta para gerenciar seus agendamentos.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" class="text-zinc-400 text-xs ml-1 mb-1" />
            <x-text-input id="email" 
                class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                placeholder="seu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" class="text-zinc-400 text-xs ml-1 mb-1" />
            <x-text-input id="password" 
                class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm"
                type="password"
                name="password"
                required 
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="flex items-center justify-between mt-5 px-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded bg-zinc-800 border-zinc-700 text-blue-600 focus:ring-blue-500 w-4 h-4" name="remember">
                <span class="ms-2 text-xs text-zinc-400">{{ __('Manter conectado') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-blue-400 hover:text-blue-300 transition-colors" href="{{ route('password.request') }}">
                    {{ __('Esqueceu?') }}
                </a>
            @endif
        </div>

        <div class="mt-8">
            <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-500 text-white py-3 rounded-lg text-sm font-bold uppercase tracking-widest transition-all active:scale-[0.98]">
                {{ __('Entrar') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-zinc-500 text-sm">
                Não tem uma conta? 
                <a href="{{ route('register') }}" class="text-blue-400 hover:underline font-medium">Cadastre-se!</a>
            </p>
        </div>
    </form>
</x-guest-layout>