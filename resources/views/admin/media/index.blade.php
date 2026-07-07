@extends('layouts.admin')

@section('title', 'Media Library')
@section('heading', 'Media Library')
@section('subheading', 'Images uploaded here can be reused across the site (max 8MB, jpg/png/webp/svg — auto-resized and compressed).')

@section('content')
    <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data"
          class="mb-8 bg-white border border-primary-100 rounded-2xl p-6 flex flex-wrap items-end gap-4">
        @csrf
        <div class="flex-1 min-w-[200px]">
            <label for="file" class="block text-sm font-medium text-primary-900 mb-1.5">Upload image</label>
            <input type="file" id="file" name="file" accept="image/png,image/jpeg,image/webp,image/svg+xml" required class="w-full text-sm">
            @error('file') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="flex-1 min-w-[200px]">
            <label for="alt_text" class="block text-sm font-medium text-primary-900 mb-1.5">Alt text</label>
            <input type="text" id="alt_text" name="alt_text" class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </div>
        <button type="submit" class="bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-2.5 rounded-lg">Upload</button>
    </form>

    @if($media->isEmpty())
        <div class="rounded-2xl border border-dashed border-primary-200 p-16 text-center text-ink-muted">
            No images uploaded yet.
        </div>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($media as $item)
                <div class="rounded-xl border border-primary-100 bg-white overflow-hidden">
                    <div class="aspect-square bg-primary-50">
                        <img src="{{ asset('storage/'.$item->path) }}" alt="{{ $item->alt_text }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-2 flex items-center justify-between">
                        <p class="text-xs text-ink-muted truncate">{{ $item->filename }}</p>
                        <x-admin.delete-button :action="route('admin.media.destroy', $item)" label="×" />
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6">{{ $media->links() }}</div>
    @endif
@endsection
