@extends('layouts.admin')

@section('title', 'Message from ' . $message->name)
@section('heading', 'Message from ' . $message->name)

@section('content')
    <div class="max-w-2xl bg-white border border-primary-100 rounded-2xl p-8">
        <dl class="grid grid-cols-2 gap-4 text-sm mb-6 pb-6 border-b border-primary-50">
            <div><dt class="text-ink-muted">Email</dt><dd class="font-medium text-primary-900">{{ $message->email }}</dd></div>
            <div><dt class="text-ink-muted">Phone</dt><dd class="font-medium text-primary-900">{{ $message->phone ?: '—' }}</dd></div>
            <div><dt class="text-ink-muted">Received</dt><dd class="font-medium text-primary-900">{{ $message->created_at->format('d M Y, g:ia') }}</dd></div>
        </dl>
        <p class="text-primary-900 leading-relaxed whitespace-pre-line">{{ $message->message }}</p>

        <div class="flex gap-3 mt-8">
            <a href="mailto:{{ $message->email }}" class="bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3 rounded-xl">
                Reply by Email
            </a>
            <a href="{{ route('admin.contact-messages.index') }}" class="px-6 py-3 text-ink-muted font-medium">Back to list</a>
        </div>
    </div>
@endsection
