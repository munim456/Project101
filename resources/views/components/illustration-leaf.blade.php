@props(['class' => 'w-24 h-24'])

<svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} aria-hidden="true">
    <path d="M50 12C33 12 20 26 20 44c0 21 15 36 30 44 15-8 30-23 30-44C80 26 67 12 50 12Z"
          class="fill-sage-100 stroke-sage-600" stroke-width="2.5" />
    <path d="M50 24V80" class="stroke-sage-600" stroke-width="2.5" stroke-linecap="round" />
    <path d="M50 36c-6-6-14-6-18-2M50 50c-8-6-18-4-22 1M50 64c-6-5-14-4-18 0" class="stroke-sage-600" stroke-width="2" stroke-linecap="round" />
    <path d="M50 36c6-6 14-6 18-2M50 50c8-6 18-4 22 1M50 64c6-5 14-4 18 0" class="stroke-sage-600" stroke-width="2" stroke-linecap="round" />
    <circle cx="50" cy="44" r="4" class="fill-primary/40" />
</svg>
