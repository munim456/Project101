@extends('layouts.admin')

@php($editing = $doctor->exists)
@section('title', $editing ? 'Edit Doctor' : 'Add Doctor')
@section('heading', $editing ? 'Edit Doctor' : 'Add Doctor')

@section('content')
    <form method="POST" action="{{ $editing ? route('admin.doctors.update', $doctor) : route('admin.doctors.store') }}"
          enctype="multipart/form-data" class="max-w-2xl space-y-6 bg-white border border-primary-100 rounded-2xl p-8">
        @csrf
        @if($editing) @method('PUT') @endif

        <x-admin.field label="Full name" name="name">
            <input type="text" id="name" name="name" value="{{ old('name', $doctor->name) }}" required
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="Role" name="role" hint="e.g. Practice Principal, General Practitioner">
            <input type="text" id="role" name="role" value="{{ old('role', $doctor->role) }}"
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="Qualifications" name="qualifications">
            <input type="text" id="qualifications" name="qualifications" value="{{ old('qualifications', $doctor->qualifications) }}"
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="Bio" name="bio">
            <textarea id="bio" name="bio" rows="4"
                      class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">{{ old('bio', $doctor->bio) }}</textarea>
        </x-admin.field>

        <x-admin.field label="Photo" name="photo">
            <input type="file" id="photo" name="photo" accept="image/png,image/jpeg,image/webp" class="w-full text-sm">
        </x-admin.field>

        <x-admin.field label="Display order" name="sort_order">
            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $doctor->sort_order ?? 0) }}"
                   class="w-32 rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <label class="flex items-center gap-2 text-sm font-medium text-primary-900">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $doctor->is_active ?? true) ? 'checked' : '' }}
                   class="rounded border-primary-300 text-primary focus:ring-primary">
            Visible on the live site
        </label>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3 rounded-xl">
                Save Doctor
            </button>
            <a href="{{ route('admin.doctors.index') }}" class="px-6 py-3 text-ink-muted font-medium">Cancel</a>
        </div>
    </form>
@endsection
