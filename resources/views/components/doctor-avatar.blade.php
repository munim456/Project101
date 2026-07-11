@props(['doctor', 'class' => ''])

@php
    $initials = collect(explode(' ', $doctor->name))
        ->reject(fn ($part) => in_array(strtolower(rtrim($part, '.')), ['dr', 'mr', 'mrs', 'ms', 'prof']))
        ->take(2)
        ->map(fn ($part) => mb_substr($part, 0, 1))
        ->implode('');
@endphp

<div {{ $attributes->merge(['class' => 'aspect-square rounded-2xl overflow-hidden transition-transform duration-300 hover:scale-105 ' . $class]) }}>
    @if($doctor->photo)
        <img src="{{ asset('storage/'.$doctor->photo) }}" alt="{{ $doctor->name }}"
             loading="lazy" class="w-full h-full object-cover">
    @else
        <div class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
            <span class="font-display text-4xl font-semibold text-primary/40">{{ $initials }}</span>
        </div>
    @endif
</div>
