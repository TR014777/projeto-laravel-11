<!--Form simples para criar e atualizar usuários-->
<div class="mt-6 space-y-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <x-alert />
    @csrf()

    <!-- Nome -->
    <div class="mb-5">
        <x-input-label for="name" :value="__('Nome')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
            :value="old('name', $user->name ?? '')" required autofocus autocomplete="name" />
    </div>

    <!-- Email -->
    <div class="mb-5">
        <x-input-label for="email" :value="__('E-mail')" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" 
            :value="old('email', $user->email ?? '')" required autocomplete="email" />
    </div>

    <!-- Telefone -->
    <div class="mb-5">
        <x-input-label for="phone" :value="__('Telefone (Opcional)')" />
        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" 
            :value="old('phone', $user->phone ?? '')" placeholder="(99) 99999-9999" />  
    </div>

    <!-- Data de Nascimento -->
    <div class="mb-5">
        <x-input-label for="birth_date" :value="__('Data de Nascimento')" />
        <input type="date" id="birth_date" name="birth_date" 
            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
            value="{{ old('birth_date', (isset($user) && $user->birth_date) ? $user->birth_date->format('Y-m-d') : '') }}" />
    </div>

    <!-- Senha -->
    <div class="mb-5">
        <x-input-label for="password" :value="__('Senha')" />
        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" placeholder="Senha" />
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