@props(['action', 'label' => 'Delete'])
<form method="POST" action="{{ $action }}" onsubmit="return confirm('Delete this? This cannot be undone.');" class="inline-block">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">{{ $label }}</button>
</form>
