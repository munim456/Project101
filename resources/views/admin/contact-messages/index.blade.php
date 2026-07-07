@extends('layouts.admin')

@section('title', 'Contact Submissions')
@section('heading', 'Contact Submissions')
@section('subheading', 'Messages sent through the website contact form.')

@section('content')
    <div class="rounded-2xl border border-primary-100 bg-white overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-primary-50 text-primary-900 text-xs uppercase tracking-wide">
                <tr>
                    <th class="text-left px-5 py-3">From</th>
                    <th class="text-left px-5 py-3">Message</th>
                    <th class="text-left px-5 py-3">Received</th>
                    <th class="text-right px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary-50">
                @forelse($messages as $message)
                    <tr class="{{ $message->is_read ? '' : 'bg-primary-50/40' }}">
                        <td class="px-5 py-3">
                            <p class="font-medium text-primary-900">{{ $message->name }}</p>
                            <p class="text-xs text-ink-muted">{{ $message->email }}</p>
                        </td>
                        <td class="px-5 py-3 text-ink-muted max-w-sm truncate">{{ $message->message }}</td>
                        <td class="px-5 py-3 text-ink-muted whitespace-nowrap">{{ $message->created_at->format('d M Y, g:ia') }}</td>
                        <td class="px-5 py-3 text-right space-x-4">
                            <a href="{{ route('admin.contact-messages.show', $message) }}" class="text-primary font-medium hover:underline">
                                {{ $message->is_read ? 'View' : 'Read' }}
                            </a>
                            <x-admin.delete-button :action="route('admin.contact-messages.destroy', $message)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-5 py-8 text-center text-ink-muted">No messages yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $messages->links() }}</div>
@endsection
