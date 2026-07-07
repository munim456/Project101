@extends('layouts.admin')

@section('title', 'Services')
@section('heading', 'Services')
@section('subheading', 'What appears in the homepage service cards and services page.')
@section('actions')
    <a href="{{ route('admin.services.create') }}" class="bg-accent hover:bg-accent-dark text-white font-semibold text-sm px-4 py-2.5 rounded-lg">
        + Add Service
    </a>
@endsection

@section('content')
    <div class="rounded-2xl border border-primary-100 bg-white overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-primary-50 text-primary-900 text-xs uppercase tracking-wide">
                <tr>
                    <th class="text-left px-5 py-3">Order</th>
                    <th class="text-left px-5 py-3">Title</th>
                    <th class="text-left px-5 py-3">Status</th>
                    <th class="text-right px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary-50">
                @forelse($services as $service)
                    <tr>
                        <td class="px-5 py-3 text-ink-muted font-variant-tabular">{{ $service->sort_order }}</td>
                        <td class="px-5 py-3 font-medium text-primary-900">{{ $service->title }}</td>
                        <td class="px-5 py-3">
                            <span class="text-xs px-2 py-1 rounded-full {{ $service->is_active ? 'bg-primary-50 text-primary-900' : 'bg-gray-100 text-gray-500' }}">
                                {{ $service->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-right space-x-4">
                            <a href="{{ route('admin.services.edit', $service) }}" class="text-primary font-medium hover:underline">Edit</a>
                            <x-admin.delete-button :action="route('admin.services.destroy', $service)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-5 py-8 text-center text-ink-muted">No services yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
