<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('dashboard.partials.welcome')
            
            @include('dashboard.partials.stats-cards')

            @include('dashboard.partials.local-charts')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @include('dashboard.partials.next-appointment')
                @include('dashboard.partials.today-appointment')
            </div>

            @include('dashboard.partials.recent-history')

            @if(Auth::user()->is_admin)
                @include('dashboard.partials.admin-section')
            @endif
        </div>
    </div>

    @include('dashboard.partials.scripts')
</x-app-layout>