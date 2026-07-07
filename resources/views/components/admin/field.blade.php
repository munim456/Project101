@props(['label', 'name', 'hint' => null])
<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-primary-900 mb-1.5">{{ $label }}</label>
    {{ $slot }}
    @if($hint)
        <p class="text-xs text-ink-muted mt-1">{{ $hint }}</p>
    @endif
    @error($name)
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
