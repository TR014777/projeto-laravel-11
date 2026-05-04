<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Agendan') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
            
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <style>
        body { font-family: 'Figtree', sans-serif; }
        .bg-agendan { color: #1f49c7; }
        .bg-agendan-soft { background-color: rgba(31, 73, 199, 0.1); }
    </style>
    <body class="antialiased bg-black">
        
        <div class="relative min-h-screen flex flex-col md:flex-row">
            
            <div class="relative w-full md:w-1/2 lg:w-2/3 h-64 md:h-screen overflow-hidden border-b md:border-b-0 md:border-r border-zinc-800">

                <img id="background" 
                    src="{{ asset('sources/welcome_background.png') }}" 
                    alt="Background"
                    class="absolute inset-0 w-full h-full object-cover opacity-60" />
    
                <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-black/80 via-black/20 to-transparent"></div>
                
                <div class="absolute inset-0 flex flex-col items-center justify-center p-8">
                    <div>
                        <a href="/" class="flex flex-col items-center gap-4">
                            <div class="p-4 bg-blue-600/20 backdrop-blur-md rounded-2xl border border-blue-500/30">
                                <x-application-logo class="w-16 h-16 fill-current text-blue-500" />
                            </div>
                            <h1 class="text-2xl font-black tracking-tighter uppercase italic text-white text-bold">Agendan</h1>
                        </a>
                    </div>
                </div>
            </div>

            <div class="relative w-full md:w-1/2 lg:w-1/3 flex items-center justify-center p-6 bg-zinc-950">
                
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-blue-500/10 blur-[100px] pointer-events-none"></div>

                <div class="w-full max-w-md relative z-10">
                    <div class="mb-8 md:hidden text-center">
                        <h2 class="text-xl text-zinc-400 font-medium italic">Seja bem-vindo de volta.</h2>
                    </div>

                    <div class="bg-zinc-900/40 backdrop-blur-sm p-8 rounded-3xl border border-zinc-800 shadow-2xl">
                        {{ $slot }}
                    </div>
                    
                    <p class="mt-8 text-center text-zinc-600 text-xs tracking-widest">
                        &copy; {{ date('Y') }} Agendan - Feito por <a href="https://github.com/TR014777" style="color: #1f49c7;">Daniel</a>.
                    </p>
                </div>
            </div>

        </div>
    </body>
</html>