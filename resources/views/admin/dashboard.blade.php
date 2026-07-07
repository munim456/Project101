@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')
@section('subheading', 'Overview of your website content.')

@section('content')
    <div class="grid sm:grid-cols-3 gap-6 mb-10">
        <div class="rounded-2xl border border-primary-100 bg-white p-6">
            <p class="text-xs font-bold uppercase tracking-wide text-ink-muted mb-2">Published Posts</p>
            <p class="text-3xl font-display font-semibold text-primary-900">{{ $publishedPostsCount }}</p>
        </div>
        <div class="rounded-2xl border border-primary-100 bg-white p-6">
            <p class="text-xs font-bold uppercase tracking-wide text-ink-muted mb-2">Unread Messages</p>
            <p class="text-3xl font-display font-semibold text-primary-900">{{ $unreadMessagesCount }}</p>
        </div>
        <div class="rounded-2xl border border-primary-100 bg-white p-6">
            <p class="text-xs font-bold uppercase tracking-wide text-ink-muted mb-2">Total Messages</p>
            <p class="text-3xl font-display font-semibold text-primary-900">{{ $totalMessagesCount }}</p>
        </div>
    </div>

    <div class="rounded-2xl border border-primary-100 bg-white p-6 mb-10">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-primary-900">Recent Posts</h2>
            <a href="{{ route('admin.posts.index') }}" class="text-sm text-primary font-medium hover:underline">View all</a>
        </div>
        @if($recentPosts->isEmpty())
            <p class="text-sm text-ink-muted">No posts yet — create your first one from the Blog Posts page.</p>
        @else
            <ul class="divide-y divide-primary-50">
                @foreach($recentPosts as $post)
                    <li class="py-3 flex items-center justify-between">
                        <span class="text-sm font-medium text-primary-900">{{ $post->title }}</span>
                        <span class="text-xs px-2 py-1 rounded-full {{ $post->status === 'published' ? 'bg-primary-50 text-primary-900' : 'bg-amber-50 text-amber-900' }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach([
            ['route' => 'admin.sections.edit', 'params' => ['hero'], 'label' => 'Edit Hero Section'],
            ['route' => 'admin.services.index', 'params' => [], 'label' => 'Manage Services'],
            ['route' => 'admin.doctors.index', 'params' => [], 'label' => 'Manage Doctors'],
            ['route' => 'admin.posts.create', 'params' => [], 'label' => 'Write New Post'],
            ['route' => 'admin.contact-messages.index', 'params' => [], 'label' => 'View Messages'],
            ['route' => 'admin.settings.edit', 'params' => [], 'label' => 'Site Settings'],
        ] as $link)
            <a href="{{ route($link['route'], $link['params']) }}"
               class="rounded-xl border border-primary-100 bg-white p-5 text-sm font-medium text-primary-900 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                {{ $link['label'] }} →
            </a>
        @endforeach
    </div>
@endsection
