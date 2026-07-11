@php
    $healthengineUrl = \App\Models\Setting::get('healthengine_url');
@endphp
<a href="{{ $healthengineUrl ?: route('booking') }}"
   @if($healthengineUrl) target="_blank" rel="noopener" @endif
   {{ $attributes->merge(['class' => 'transition-transform duration-200 hover:scale-105 active:scale-95']) }}>{{ $slot }}</a>
