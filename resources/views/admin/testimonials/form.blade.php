@extends('layouts.admin')

@php($editing = $testimonial->exists)
@section('title', $editing ? 'Edit Testimonial' : 'Add Testimonial')
@section('heading', $editing ? 'Edit Testimonial' : 'Add Testimonial')

@section('content')
    <form method="POST" action="{{ $editing ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}"
          class="max-w-2xl space-y-6 bg-white border border-primary-100 rounded-2xl p-8">
        @csrf
        @if($editing) @method('PUT') @endif

        <x-admin.field label="Patient name" name="name">
            <input type="text" id="name" name="name" value="{{ old('name', $testimonial->name) }}" required
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="Testimonial" name="content">
            <textarea id="content" name="content" rows="4" required
                      class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">{{ old('content', $testimonial->content) }}</textarea>
        </x-admin.field>

        <x-admin.field label="Rating" name="rating">
            <select id="rating" name="rating" class="w-32 rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
                @for($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>{{ $i }} star{{ $i > 1 ? 's' : '' }}</option>
                @endfor
            </select>
        </x-admin.field>

        <label class="flex items-center gap-2 text-sm font-medium text-primary-900">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}
                   class="rounded border-primary-300 text-primary focus:ring-primary">
            Show on the live site
        </label>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3 rounded-xl">Save</button>
            <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-3 text-ink-muted font-medium">Cancel</a>
        </div>
    </form>
@endsection
