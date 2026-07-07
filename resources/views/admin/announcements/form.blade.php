@extends('layouts.admin')

@php($editing = $announcement->exists)
@section('title', $editing ? 'Edit Announcement' : 'Add Announcement')
@section('heading', $editing ? 'Edit Announcement' : 'Add Announcement')

@section('content')
    <form method="POST" action="{{ $editing ? route('admin.announcements.update', $announcement) : route('admin.announcements.store') }}"
          class="max-w-2xl space-y-6 bg-white border border-primary-100 rounded-2xl p-8">
        @csrf
        @if($editing) @method('PUT') @endif

        <x-admin.field label="Message" name="message">
            <textarea id="message" name="message" rows="3" required
                      class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">{{ old('message', $announcement->message) }}</textarea>
        </x-admin.field>

        <x-admin.field label="Style" name="type">
            <select id="type" name="type" class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
                <option value="info" {{ old('type', $announcement->type) === 'info' ? 'selected' : '' }}>Info (teal)</option>
                <option value="warning" {{ old('type', $announcement->type) === 'warning' ? 'selected' : '' }}>Warning (amber)</option>
            </select>
        </x-admin.field>

        <div class="grid grid-cols-2 gap-5">
            <x-admin.field label="Starts (optional)" name="starts_at">
                <input type="datetime-local" id="starts_at" name="starts_at"
                       value="{{ old('starts_at', optional($announcement->starts_at)->format('Y-m-d\TH:i')) }}"
                       class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
            </x-admin.field>
            <x-admin.field label="Ends (optional)" name="ends_at">
                <input type="datetime-local" id="ends_at" name="ends_at"
                       value="{{ old('ends_at', optional($announcement->ends_at)->format('Y-m-d\TH:i')) }}"
                       class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
            </x-admin.field>
        </div>

        <label class="flex items-center gap-2 text-sm font-medium text-primary-900">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $announcement->is_active ?? true) ? 'checked' : '' }}
                   class="rounded border-primary-300 text-primary focus:ring-primary">
            Show on the live site
        </label>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3 rounded-xl">Save</button>
            <a href="{{ route('admin.announcements.index') }}" class="px-6 py-3 text-ink-muted font-medium">Cancel</a>
        </div>
    </form>
@endsection
