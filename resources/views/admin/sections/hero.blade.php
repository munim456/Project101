@extends('layouts.admin')

@section('title', 'Hero Section')
@section('heading', 'Hero Section')
@section('subheading', 'The first thing visitors see on the homepage.')

@section('content')
    <form method="POST" action="{{ route('admin.sections.update', 'hero') }}" enctype="multipart/form-data"
          class="max-w-2xl space-y-6 bg-white border border-primary-100 rounded-2xl p-8">
        @csrf
        @method('PUT')

        <x-admin.field label="Hero photo" name="image" hint="Replaces the illustrated icon panel with a real photo. JPG/PNG/WebP, max 4MB.">
            @if($section->content['image'] ?? null)
                <div class="mb-3 flex items-center gap-4">
                    <img src="{{ asset('storage/'.$section->content['image']) }}" alt="Current hero photo" class="w-32 h-24 rounded-lg object-cover border border-primary-100">
                    <label class="flex items-center gap-2 text-sm text-ink-muted">
                        <input type="checkbox" name="remove_image" value="1" class="rounded border-primary-300 text-primary focus:ring-primary">
                        Remove photo (revert to illustration)
                    </label>
                </div>
            @endif
            <input type="file" id="image" name="image" accept="image/png,image/jpeg,image/webp" class="w-full text-sm">
        </x-admin.field>

        <x-admin.field label="Heading" name="heading">
            <input type="text" id="heading" name="heading" value="{{ old('heading', $section->content['heading'] ?? '') }}" required
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="Subheading" name="subheading">
            <textarea id="subheading" name="subheading" rows="2"
                      class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">{{ old('subheading', $section->content['subheading'] ?? '') }}</textarea>
        </x-admin.field>

        <div class="grid grid-cols-2 gap-5">
            <x-admin.field label="Primary button text" name="primary_button_text">
                <input type="text" id="primary_button_text" name="primary_button_text"
                       value="{{ old('primary_button_text', $section->content['primary_button_text'] ?? '') }}"
                       class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
            </x-admin.field>
            <x-admin.field label="Secondary button text" name="secondary_button_text">
                <input type="text" id="secondary_button_text" name="secondary_button_text"
                       value="{{ old('secondary_button_text', $section->content['secondary_button_text'] ?? '') }}"
                       class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
            </x-admin.field>
        </div>
        <p class="text-xs text-ink-muted">The primary button always links to Book Appointment; the secondary to Our Services.</p>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3 rounded-xl">Save Hero Section</button>
        </div>
    </form>
@endsection
