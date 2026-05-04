<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <span class="dark:text-white">
        Olá, <strong>{{ Auth::user()->name }}</strong>! 
        @if(Auth::user()->is_admin)
            <span class="ml-2 text-xs bg-red-100 text-red-600 px-2 py-1 rounded">Modo Administrador</span>
        @endif
    </span>
</div>