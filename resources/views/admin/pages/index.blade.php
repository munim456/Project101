@extends('layouts.admin')

@section('title', 'Pages')
@section('heading', 'Static Pages')
@section('subheading', 'About, Privacy Policy, Terms, and any other static content pages.')
@section('actions')
    <a href="{{ route('admin.pages.create') }}" class="bg-accent hover:bg-accent-dark text-white font-semibold text-sm px-4 py-2.5 rounded-lg">
        + Add Page
    </a>
@endsection

@section('content')
    <div class="rounded-2xl border border-primary-100 bg-white overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-primary-50 text-primary-900 text-xs uppercase tracking-wide">
                <tr>
                    <th class="text-left px-5 py-3">Title</th>
                    <th class="text-left px-5 py-3">Slug</th>
                    <th class="text-right px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary-50">
                @forelse($pages as $page)
                    <tr>
                        <td class="px-5 py-3 font-medium text-primary-900">{{ $page->title }}</td>
                        <td class="px-5 py-3 text-ink-muted">/{{ $page->slug }}</td>
                        <td class="px-5 py-3 text-right space-x-4">
                            <a href="{{ route('admin.pages.edit', $page) }}" class="text-primary font-medium hover:underline">Edit</a>
                            <x-admin.delete-button :action="route('admin.pages.destroy', $page)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-5 py-8 text-center text-ink-muted">No pages yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
