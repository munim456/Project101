@if($announcement)
    <div data-announcement="{{ $announcement->id }}"
         class="rounded-2xl px-5 py-4 flex items-start gap-3 {{ $announcement->type === 'warning' ? 'bg-amber-50 text-amber-900 border border-amber-200' : 'bg-primary-50 text-primary-900 border border-primary-100' }}">
        <x-heroicon-o-information-circle class="w-5 h-5 flex-none mt-0.5" />
        <p class="text-sm leading-relaxed flex-1">{{ $announcement->message }}</p>
        <button data-announcement-dismiss aria-label="Dismiss notice" class="flex-none opacity-60 hover:opacity-100">
            <x-heroicon-o-x-mark class="w-4 h-4" />
        </button>
    </div>
@endif
