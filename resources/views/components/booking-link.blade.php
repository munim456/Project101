@php
    $healthengineUrl = \App\Models\Setting::get('healthengine_url');
@endphp
<a href="{{ $healthengineUrl ?: route('booking') }}"
   @if($healthengineUrl) target="_blank" rel="noopener" @endif
   {{ $attributes }}>{{ $slot }}</a>
