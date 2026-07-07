@extends('layouts.admin')

@php($editing = $service->exists)
@section('title', $editing ? 'Edit Service' : 'Add Service')
@section('heading', $editing ? 'Edit Service' : 'Add Service')

@section('content')
    <form method="POST" action="{{ $editing ? route('admin.services.update', $service) : route('admin.services.store') }}"
          enctype="multipart/form-data" class="max-w-2xl space-y-6 bg-white border border-primary-100 rounded-2xl p-8">
        @csrf
        @if($editing) @method('PUT') @endif

        <x-admin.field label="Title" name="title">
            <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}" required
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="Icon" name="icon" hint="A Heroicons outline name, e.g. heart, exclamation-triangle, user-group, academic-cap. See heroicons.com (outline set).">
            <input type="text" id="icon" name="icon" value="{{ old('icon', $service->icon) }}" required
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="Short description (shown on homepage cards)" name="short_description">
            <input type="text" id="short_description" name="short_description" value="{{ old('short_description', $service->short_description) }}" required
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="Full description (shown on the service's own page)" name="description">
            <textarea id="description" name="description" rows="5"
                      class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">{{ old('description', $service->description) }}</textarea>
        </x-admin.field>

        <x-admin.field label="Image (optional)" name="image">
            <input type="file" id="image" name="image" accept="image/png,image/jpeg,image/webp"
                   class="w-full text-sm">
        </x-admin.field>

        <x-admin.field label="Display order" name="sort_order">
            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}"
                   class="w-32 rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <label class="flex items-center gap-2 text-sm font-medium text-primary-900">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}
                   class="rounded border-primary-300 text-primary focus:ring-primary">
            Visible on the live site
        </label>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3 rounded-xl">
                Save Service
            </button>
            <a href="{{ route('admin.services.index') }}" class="px-6 py-3 text-ink-muted font-medium">Cancel</a>
        </div>
    </form>
@endsection
