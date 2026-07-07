@extends('layouts.admin')

@section('title', 'Testimonials')
@section('heading', 'Testimonials')
@section('subheading', 'Patient testimonials shown on the homepage.')
@section('actions')
    <a href="{{ route('admin.testimonials.create') }}" class="bg-accent hover:bg-accent-dark text-white font-semibold text-sm px-4 py-2.5 rounded-lg">
        + Add Testimonial
    </a>
@endsection

@section('content')
    <div class="rounded-2xl border border-primary-100 bg-white overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-primary-50 text-primary-900 text-xs uppercase tracking-wide">
                <tr>
                    <th class="text-left px-5 py-3">Name</th>
                    <th class="text-left px-5 py-3">Rating</th>
                    <th class="text-left px-5 py-3">Status</th>
                    <th class="text-right px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary-50">
                @forelse($testimonials as $testimonial)
                    <tr>
                        <td class="px-5 py-3 font-medium text-primary-900">{{ $testimonial->name }}</td>
                        <td class="px-5 py-3 text-ink-muted">{{ $testimonial->rating }} / 5</td>
                        <td class="px-5 py-3">
                            <span class="text-xs px-2 py-1 rounded-full {{ $testimonial->is_active ? 'bg-primary-50 text-primary-900' : 'bg-gray-100 text-gray-500' }}">
                                {{ $testimonial->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-right space-x-4">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-primary font-medium hover:underline">Edit</a>
                            <x-admin.delete-button :action="route('admin.testimonials.destroy', $testimonial)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-5 py-8 text-center text-ink-muted">No testimonials yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
