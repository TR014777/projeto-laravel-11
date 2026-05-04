<x-guest-layout>
    <div class="mb-6 text-center md:text-left">
        <h2 class="text-2xl font-bold text-white tracking-tight">Criar Conta</h2>
        <p class="text-zinc-400 text-xs mt-1">Cadastre-se para começar a usar o Agendan.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" class="text-zinc-400 text-xs ml-1 mb-1" />
            <x-text-input id="name" 
                class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name" 
                placeholder="Seu nome completo" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" class="text-zinc-400 text-xs ml-1 mb-1" />
            <x-text-input id="email" 
                class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autocomplete="username" 
                placeholder="seu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Birth Date -->
        <div class="mt-4">
            <x-input-label for="birth_date" :value="__('Data de Nascimento')" class="text-zinc-400 text-xs ml-1 mb-1" />
            <input type="date" id="birth_date" name="birth_date" 
                class="block w-full bg-zinc-800/40 border-zinc-700 text-zinc-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm transition-all" 
                value="{{ old('birth_date') }}" 
                required />
            <x-input-error :messages="$errors->get('birth_date')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" class="text-zinc-400 text-xs ml-1 mb-1" />
            <x-text-input id="password" 
                class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm"
                type="password"
                name="password"
                required 
                autocomplete="new-password" 
                placeholder="Crie uma senha" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" class="text-zinc-400 text-xs ml-1 mb-1" />
            <x-text-input id="password_confirmation" 
                class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password" 
                placeholder="Repita a senha" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <div class="mt-8">
            <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-500 text-white py-3 rounded-lg text-sm font-bold uppercase tracking-widest transition-all active:scale-[0.98]">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-zinc-500 text-sm">
                {{ __('Já tem uma conta?') }} 
                <a href="{{ route('login') }}" class="text-blue-400 hover:underline font-medium transition-all">
                    {{ __('Entre!') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>