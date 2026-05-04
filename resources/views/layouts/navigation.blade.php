<div x-data="{ open: true }">

    <aside 
        :class="open ? 'translate-x-0 w-64' : '-translate-x-full sm:translate-x-0 sm:w-20'"
        class="fixed top-0 left-0 z-40 h-screen transition-all duration-300 border-r border-gray-200/30 dark:border-gray-700/30 bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl">
        
        <!-- Botão Gatilho (Toggle) -->
        <button @click="open = !open" 
                class="absolute top-5 -right-12 p-2 rounded-md bg-indigo-600 text-white shadow-lg hover:bg-indigo-700 transition-colors">
            <svg class="w-6 h-6 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
            </svg>
        </button>

        <div class="h-full px-4 py-6 overflow-y-auto flex flex-col justify-between">
            <div>
                <!-- Logo -->
                <div class="flex items-center ps-2.5 mb-10 overflow-hidden">
                    <a href="/" class="flex items-center">
                        <x-application-logo class="h-8 w-8 min-w-[32px] fill-current text-indigo-600 dark:text-indigo-400" />
                        <span x-show="open" x-transition.opacity class="ms-3 text-xl font-bold tracking-tight dark:text-white whitespace-nowrap">Agendan</span>
                    </a>
                </div>

                <!-- Navegação -->
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="{{ route('dashboard') }}" 
                            class="flex items-center p-3 text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 transition-all group {{ request()->routeIs('dashboard') ? 'bg-indigo-50 dark:bg-indigo-900/40 text-indigo-600 shadow-sm' : '' }}">
                            <svg class="w-6 h-6 min-w-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 m0 0h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6"></path></svg>
                            <span x-show="open" x-transition.opacity class="ms-3 italic text-sm uppercase tracking-widest whitespace-nowrap">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('appointments.index') }}" 
                            class="flex items-center p-3 text-gray-700 rounded-lg dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 transition-all group {{ request()->routeIs('appointments.index') ? 'bg-indigo-50 dark:bg-indigo-900/40 text-indigo-600 shadow-sm' : '' }}">
                            <svg class="w-6 h-6 min-w-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span x-show="open" x-transition.opacity class="ms-3 italic text-sm uppercase tracking-widest whitespace-nowrap">Agendas</span>
                        </a>
                    </li>

                    @if(Auth::user()->is_admin)
                    <div class="pt-4 mt-4 border-t border-gray-200/50 dark:border-gray-700/50">
                        <p x-show="open" class="px-3 mb-2 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Admin</p>
                        <li>
                            <a href="{{ route('users.index') }}" class="flex items-center p-3 text-gray-600 dark:text-gray-400 hover:text-red-500 transition-colors">
                                <svg class="w-6 h-6 min-w-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span x-show="open" x-transition.opacity class="ms-3 text-sm whitespace-nowrap">Usuários</span>
                            </a>
                        </li>
                    </div>
                    @endif
                </ul>
            </div>

            <!-- Rodapé -->
            <div class="pt-4 border-t border-gray-200/50 dark:border-gray-700/50">
                <div class="flex items-center p-2 mb-4 overflow-hidden">
                    <div class="w-8 h-8 min-w-[32px] rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div x-show="open" x-transition.opacity class="ms-3">
                        <p class="text-sm font-bold dark:text-white truncate w-32">{{ Auth::user()->name }}</p>
                        <a href="{{ route('profile.edit') }}" class="text-[10px] text-gray-500 hover:text-indigo-500 uppercase font-black">Editar</a>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center p-3 text-xs font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all uppercase tracking-tighter group">
                        <svg class="w-6 h-6 min-w-[24px] transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span x-show="open" x-transition.opacity class="ms-3 whitespace-nowrap">Sair do Sistema</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <main 
        :class="open ? 'pl-64' : 'pl-20'"
        class="transition-all duration-300 min-h-screen flex flex-grow">
        <main class="flex-grow">
            @include('layouts.breadcrumb')
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto pb-6 px-4 sm:pb-4 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            {{ $slot }}
            @include('layouts.footer')
        </main>
    </main>

</div>