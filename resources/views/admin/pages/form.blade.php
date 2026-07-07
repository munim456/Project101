@extends('layouts.admin')

@php($editing = $page->exists)
@section('title', $editing ? 'Edit Page' : 'Add Page')
@section('heading', $editing ? 'Edit Page' : 'Add Page')

@section('content')
    <form method="POST" action="{{ $editing ? route('admin.pages.update', $page) : route('admin.pages.store') }}"
          class="max-w-2xl space-y-6 bg-white border border-primary-100 rounded-2xl p-8">
        @csrf
        @if($editing) @method('PUT') @endif

        <x-admin.field label="Title" name="title">
            <input type="text" id="title" name="title" value="{{ old('title', $page->title) }}" required
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        @if($editing)
            <p class="text-xs text-ink-muted -mt-4">URL: /{{ $page->slug }}</p>
        @endif

        <x-admin.field label="Content" name="body" hint="Basic HTML is supported (paragraphs, headings, links).">
            <textarea id="body" name="body" rows="10"
                      class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base font-mono text-sm">{{ old('body', $page->body) }}</textarea>
        </x-admin.field>

        <x-admin.field label="SEO meta title (optional)" name="meta_title">
            <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}"
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="SEO meta description (optional)" name="meta_description">
            <input type="text" id="meta_description" name="meta_description" value="{{ old('meta_description', $page->meta_description) }}"
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3 rounded-xl">Save Page</button>
            <a href="{{ route('admin.pages.index') }}" class="px-6 py-3 text-ink-muted font-medium">Cancel</a>
        </div>
    </form>
@endsection
