@props(['class' => 'h-10 text-primary/30'])

<div {{ $attributes->merge(['class' => 'overflow-hidden ' . $class]) }} aria-hidden="true">
    <svg viewBox="0 0 600 60" preserveAspectRatio="none" class="w-[200%] h-full animate-ecg-scroll" fill="none">
        <path d="M0,30 L50,30 L60,22 L70,30 L100,30 L108,34 L115,4 L122,50 L130,30 L160,30 L175,14 L190,30 L300,30
                 L350,30 L360,22 L370,30 L400,30 L408,34 L415,4 L422,50 L430,30 L460,30 L475,14 L490,30 L600,30"
              stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</div>
