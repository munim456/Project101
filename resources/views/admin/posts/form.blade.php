@extends('layouts.admin')

@php($editing = $post->exists)
@section('title', $editing ? 'Edit Post' : 'New Post')
@section('heading', $editing ? 'Edit Post' : 'New Post')

@section('head')
    <link rel="stylesheet" href="https://unpkg.com/trix@2.1.0/dist/trix.css">
    <script src="https://unpkg.com/trix@2.1.0/dist/trix.umd.min.js" defer></script>
    <style>
        trix-editor { min-height: 260px; border-color: #d3e9e9 !important; border-radius: 0.5rem; font-size: 1rem; }
        trix-editor:focus { border-color: #0e6e6e !important; }
    </style>
@endsection

@section('content')
    <form method="POST" action="{{ $editing ? route('admin.posts.update', $post) : route('admin.posts.store') }}"
          enctype="multipart/form-data" class="max-w-3xl space-y-6 bg-white border border-primary-100 rounded-2xl p-8">
        @csrf
        @if($editing) @method('PUT') @endif

        <x-admin.field label="Title" name="title">
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="URL slug" name="slug" hint="Leave blank to auto-generate from the title. e.g. managing-diabetes-with-your-gp">
            <input type="text" id="slug" name="slug" value="{{ old('slug', $post->slug) }}"
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="Excerpt" name="excerpt" hint="Short summary shown on blog cards.">
            <input type="text" id="excerpt" name="excerpt" value="{{ old('excerpt', $post->excerpt) }}"
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="Content" name="body">
            <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
            <trix-editor input="body" class="trix-content"></trix-editor>
        </x-admin.field>

        <div class="grid grid-cols-2 gap-5">
            <x-admin.field label="Category" name="category_id">
                <select id="category_id" name="category_id" class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
                    <option value="">— None —</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </x-admin.field>

            <x-admin.field label="Featured image" name="featured_image">
                <input type="file" id="featured_image" name="featured_image" accept="image/png,image/jpeg,image/webp" class="w-full text-sm">
            </x-admin.field>
        </div>

        @if($tags->isNotEmpty())
            <div>
                <label class="block text-sm font-medium text-primary-900 mb-2">Tags</label>
                <div class="flex flex-wrap gap-3">
                    @foreach($tags as $tag)
                        <label class="flex items-center gap-1.5 text-sm bg-primary-50 px-3 py-1.5 rounded-full">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                   {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->all())) ? 'checked' : '' }}
                                   class="rounded border-primary-300 text-primary focus:ring-primary">
                            {{ $tag->name }}
                        </label>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="grid grid-cols-2 gap-5">
            <x-admin.field label="Status" name="status">
                <select id="status" name="status" class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
                    <option value="draft" {{ old('status', $post->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </x-admin.field>
            <x-admin.field label="Publish date" name="published_at" hint="Leave blank to publish immediately.">
                <input type="datetime-local" id="published_at" name="published_at"
                       value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}"
                       class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
            </x-admin.field>
        </div>

        <div class="border-t border-primary-50 pt-6 space-y-6">
            <p class="text-xs font-bold uppercase tracking-wide text-ink-muted">SEO (optional)</p>
            <x-admin.field label="Meta title" name="meta_title">
                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}"
                       class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
            </x-admin.field>
            <x-admin.field label="Meta description" name="meta_description">
                <input type="text" id="meta_description" name="meta_description" value="{{ old('meta_description', $post->meta_description) }}"
                       class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
            </x-admin.field>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3 rounded-xl">Save Post</button>
            <a href="{{ route('admin.posts.index') }}" class="px-6 py-3 text-ink-muted font-medium">Cancel</a>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        document.addEventListener('trix-attachment-add', function (event) {
            const attachment = event.attachment;
            if (!attachment.file) return;

            const formData = new FormData();
            formData.append('file', attachment.file);

            fetch('{{ route('admin.posts.upload-attachment') }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => attachment.setAttributes({ url: data.url, href: data.url }));
        });
    </script>
@endsection
