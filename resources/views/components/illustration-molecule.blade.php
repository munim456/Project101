@props(['class' => 'w-20 h-20'])

<svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }} aria-hidden="true">
    <path d="M50 20 20 50 50 80 80 50Z" class="stroke-sage-600/60" stroke-width="2" />
    <path d="M50 20 80 50 50 80 20 50Z" class="stroke-primary/30" stroke-width="2" />
    <circle cx="50" cy="20" r="7" class="fill-sage-100 stroke-sage-600" stroke-width="2" />
    <circle cx="80" cy="50" r="7" class="fill-primary-50 stroke-primary/60" stroke-width="2" />
    <circle cx="50" cy="80" r="7" class="fill-sage-100 stroke-sage-600" stroke-width="2" />
    <circle cx="20" cy="50" r="7" class="fill-primary-50 stroke-primary/60" stroke-width="2" />
    <circle cx="50" cy="50" r="5" class="fill-accent/30" />
</svg>
