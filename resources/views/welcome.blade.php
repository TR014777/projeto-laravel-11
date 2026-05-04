<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Agendan - Sistema de Agendamentos</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,600,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <style>
            body { font-family: 'Figtree', sans-serif; }
            
            .bento-card {
                position: relative;
                overflow: hidden;
            }
            .glass-effect {
                background: rgba(15, 23, 42, 0.6); 
                backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.08);
            }
            .gradient-text {
                background: linear-gradient(135deg, #fff 30%, #4f75ff 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        </style>
    </head>
    <body class="antialiased bg-slate-950 text-white selection:bg-[#1f49c7]">
        
        <!-- Fundo original do usuário -->
        <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
            <img id="background" 
                 src="{{ asset('sources/welcome_background.png') }}" 
                 alt="Background"
                 class="w-full h-full object-cover opacity-40" />
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/20 via-slate-950/80 to-slate-950"></div>
        </div>

        <div class="relative z-10 w-full max-w-7xl px-6 mx-auto">
            
            <header class="flex justify-between items-center py-8">
                <div class="flex items-center gap-3">
                    <div class="flex flex-row items-center gap-4">
                        <div class="p-2 bg-blue-600/20 backdrop-blur-md rounded-2xl border border-blue-500/30">
                            <x-application-logo class="w-10 h-10 fill-current text-blue-500" />
                        </div>
                        <h1 class="text-2xl font-black tracking-tighter uppercase italic text-white text-bold">Agendan</h1>
                    </div>
                </div>
                
                @if (Route::has('login'))
                    <nav class="flex gap-2 p-1 bg-white/5 backdrop-blur-md rounded-2xl border border-white/10">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-2 rounded-xl hover:bg-white/10 transition font-medium text-sm">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2 rounded-xl hover:bg-white/10 transition font-medium text-sm">Entrar</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-2 rounded-xl hover:bg-white/10 transition font-medium text-sm">Cadastre-se</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <main class="mt-16 pb-20">
                <div class="text-center mb-24">
                    <h1 class="text-6xl md:text-8xl font-black mb-6 tracking-tight leading-[0.9]">
                        Agende. <br> <span class="gradient-text">Gerencie.</span>
                    </h1>
                    <p class="text-xl text-slate-400 max-w-xl mx-auto leading-relaxed">
                        A solução definitiva para agendamento. Organize sua agenda, 
                        <strong>evite conflitos</strong> e profissionalize seu atendimento.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <div class="md:col-span-2 bento-card glass-effect rounded-[2.5rem] p-10 flex flex-col justify-between border-b-4 border-b-blue-600">
                        <div class="bg-blue-600/20 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 text-blue-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-extrabold mb-3">A Evolução do seu fluxo</h2>
                            <p class="text-slate-400 max-w-md">
                                Chega de agendas lotadas que não respeitam seu descanso. Defina seus próprios horários, automatize e recupere o controle sobre o seu tempo.
                            </p>
                        </div>
                    </div>

                    <div class="bento-card glass-effect rounded-[2.5rem] p-10 flex flex-col">
                        <div class="bg-blue-600/20 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 text-blue-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-extrabold mb-3">Disponibilidade</h2>
                        <p class="text-slate-400 text-sm">Controle total sobre seus horários. Permite que você visualize e organize seus agendamentos de forma dinâmica e rápida.</p>
                    </div>

                    <div class="bento-card bg-white text-slate-950 rounded-[2.5rem] p-10">
                        <h2 class="text-2xl font-bold mb-2 italic uppercase tracking-tighter">Eficiência</h2>
                        <ul class="space-y-4 font-bold">
                            <li class="flex items-center gap-3">
                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                <span class="text-sm">Tabela organizada</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                <span class="text-sm">Link de Agendamento</span>
                            </li>
                        </ul>
                    </div>

                    <div class="md:col-span-2 bento-card glass-effect rounded-[2.5rem] p-10 flex flex-col sm:flex-row items-center gap-8 overflow-hidden">
                        <div class="shrink-0 w-24 h-24 bg-blue-600/20 rounded-full flex items-center justify-center text-blue-400">
                             <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold mb-2">Painel de Controle</h2>
                            <p class="text-slate-400 text-sm">
                                Tenha uma visão clara do fluxo de clientes diários, semanais e mensais. Vigie a demanda sem perder suas métricas.
                            </p>
                        </div>
                    </div>

                </div>
            </main>
            @include('layouts.footer')
        </div>
    </body>
</html>