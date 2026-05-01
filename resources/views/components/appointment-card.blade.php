@props(['appointment'])

@php
    $start = \Carbon\Carbon::parse($appointment->start);
    $end = \Carbon\Carbon::parse($appointment->end);
    
    $top = ($start->format('i') / 60) * 10; 
    $height = ($start->diffInMinutes($end) / 60) * 10;
@endphp

<!--Tag especial para o card do agendamento-->
<div class="absolute inset-x-1 z-10 flex flex-col items-center justify-center text-white rounded-lg shadow-md border border-white/20 p-1 text-center overflow-hidden"
    style="height: {{ $height }}rem; top: {{ $top }}rem; width: 100%; background-color: {{ $appointment->color ?? '#3B82F6' }}; background-image: linear-gradient(135deg, {{ $appointment->color ?? '#3B82F6' }} 25%, rgba(255,255,255,0.1) 25%, rgba(255,255,255,0.1) 50%, {{ $appointment->color ?? '#3B82F6' }} 50%, {{ $appointment->color ?? '#3B82F6' }} 75%, rgba(255,255,255,0.1) 75%, rgba(255,255,255,0.1) 100%); background-size: 10px 10px;">
    <a href="{{ route('appointments.show', $appointment) }}" class="absolute inset-0 z-20">
        <p class="text-[10px] font-bold uppercase truncate w-full">{{ $appointment->client }}</p>
        <p class="text-[9px] opacity-80">{{ $start->format('H:i') }} - {{ $end->format('H:i') }}</p>
    </a>
</div>