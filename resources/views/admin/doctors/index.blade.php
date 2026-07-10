@extends('layouts.admin')

@section('title', 'Doctors')
@section('heading', 'Doctors')
@section('subheading', 'Doctor profiles shown on the homepage, About page, and Doctors page.')
@section('actions')
    <a href="{{ route('admin.doctors.create') }}" class="bg-accent hover:bg-accent-dark text-white font-semibold text-sm px-4 py-2.5 rounded-lg">
        + Add Doctor
    </a>
@endsection

@section('content')
    <div class="rounded-2xl border border-primary-100 bg-white overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-primary-50 text-primary-900 text-xs uppercase tracking-wide">
                <tr>
                    <th class="text-left px-5 py-3">Order</th>
                    <th class="text-left px-5 py-3">Name</th>
                    <th class="text-left px-5 py-3">Role</th>
                    <th class="text-left px-5 py-3">Current Status</th>
                    <th class="text-left px-5 py-3">Visibility</th>
                    <th class="text-right px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary-50">
                @forelse($doctors as $doctor)
                    <tr>
                        <td class="px-5 py-3 text-ink-muted">{{ $doctor->sort_order }}</td>
                        <td class="px-5 py-3 font-medium text-primary-900">{{ $doctor->name }}</td>
                        <td class="px-5 py-3 text-ink-muted">{{ $doctor->role }}</td>
                        <td class="px-5 py-3 text-ink-muted">{{ $doctor->status }}</td>
                        <td class="px-5 py-3">
                            <span class="text-xs px-2 py-1 rounded-full {{ $doctor->is_active ? 'bg-primary-50 text-primary-900' : 'bg-gray-100 text-gray-500' }}">
                                {{ $doctor->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-right space-x-4">
                            <a href="{{ route('admin.doctors.edit', $doctor) }}" class="text-primary font-medium hover:underline">Edit</a>
                            <x-admin.delete-button :action="route('admin.doctors.destroy', $doctor)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-8 text-center text-ink-muted">No doctors yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
