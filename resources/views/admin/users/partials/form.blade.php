<!--Form simples para criar e atualizar usuários-->
<div class="mt-6 space-y-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <x-alert />
    @csrf()

    <!-- Nome -->
    <div class="mb-5">
        <x-input-label class="text-zinc-400 text-xs ml-1 mb-1" for="name" :value="__('Nome')" />
        <x-text-input id="name" name="name" type="text" class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm" 
            :value="old('name', $user->name ?? '')" required autofocus autocomplete="name" />
    </div>

    <!-- Email -->
    <div class="mb-5">
        <x-input-label class="text-zinc-400 text-xs ml-1 mb-1" for="email" :value="__('E-mail')" />
        <x-text-input id="email" name="email" type="email" class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm" 
            :value="old('email', $user->email ?? '')" required autocomplete="email" />
    </div>

    <!-- Telefone -->
    <div class="mb-5">
        <x-input-label class="text-zinc-400 text-xs ml-1 mb-1" for="phone" :value="__('Telefone (Opcional)')" />
        <x-text-input id="phone" name="phone" type="text" class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm" 
            :value="old('phone', $user->phone ?? '')" placeholder="+55 (99) 99999-9999" />  
    </div>

    <!-- Data de Nascimento -->
    <div class="mb-5">
        <x-input-label class="text-zinc-400 text-xs ml-1 mb-1" for="birth_date" :value="__('Data de Nascimento')" />
        <input type="date" id="birth_date" name="birth_date" 
            class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
            value="{{ old('birth_date', (isset($user) && $user->birth_date) ? $user->birth_date->format('Y-m-d') : '') }}" />
    </div>

    <!-- Senha -->
    <div class="mb-5">
        <x-input-label class="text-zinc-400 text-xs ml-1 mb-1" for="password" :value="__('Senha')" />
        <x-text-input id="password" name="password" type="password" class="block w-full bg-zinc-800/40 border-zinc-700 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm rounded-lg py-2.5 px-4 text-sm" placeholder="Senha" />
    </div>

    <!-- Botões -->
    <div class="flex flex-row justify-end gap-4">
        <x-secondary-button type="button">
            <a href="{{ route('users.index') }}">{{ __('Voltar') }}</a>
        </x-secondary-button>
        <x-primary-button type="submit">
            {{ __('Enviar') }}
        </x-primary-button>
    </div>
</div>