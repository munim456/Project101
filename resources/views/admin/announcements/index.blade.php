@extends('layouts.admin')

@section('title', 'Announcements')
@section('heading', 'Health Notices & Announcements')
@section('subheading', 'Dismissible banners shown on the homepage.')
@section('actions')
    <a href="{{ route('admin.announcements.create') }}" class="bg-accent hover:bg-accent-dark text-white font-semibold text-sm px-4 py-2.5 rounded-lg">
        + Add Announcement
    </a>
@endsection

@section('content')
    <div class="rounded-2xl border border-primary-100 bg-white overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-primary-50 text-primary-900 text-xs uppercase tracking-wide">
                <tr>
                    <th class="text-left px-5 py-3">Message</th>
                    <th class="text-left px-5 py-3">Type</th>
                    <th class="text-left px-5 py-3">Status</th>
                    <th class="text-right px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary-50">
                @forelse($announcements as $announcement)
                    <tr>
                        <td class="px-5 py-3 font-medium text-primary-900 max-w-md truncate">{{ $announcement->message }}</td>
                        <td class="px-5 py-3 text-ink-muted capitalize">{{ $announcement->type }}</td>
                        <td class="px-5 py-3">
                            <span class="text-xs px-2 py-1 rounded-full {{ $announcement->is_active ? 'bg-primary-50 text-primary-900' : 'bg-gray-100 text-gray-500' }}">
                                {{ $announcement->is_active ? 'On' : 'Off' }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-right space-x-4">
                            <a href="{{ route('admin.announcements.edit', $announcement) }}" class="text-primary font-medium hover:underline">Edit</a>
                            <x-admin.delete-button :action="route('admin.announcements.destroy', $announcement)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-5 py-8 text-center text-ink-muted">No announcements yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
