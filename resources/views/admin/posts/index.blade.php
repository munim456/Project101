@extends('layouts.admin')

@section('title', 'Blog Posts')
@section('heading', 'Blog Posts')
@section('subheading', 'Health articles and clinic news shown on the homepage and blog.')
@section('actions')
    <a href="{{ route('admin.posts.create') }}" class="bg-accent hover:bg-accent-dark text-white font-semibold text-sm px-4 py-2.5 rounded-lg">
        + Write New Post
    </a>
@endsection

@section('content')
    <div class="rounded-2xl border border-primary-100 bg-white overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-primary-50 text-primary-900 text-xs uppercase tracking-wide">
                <tr>
                    <th class="text-left px-5 py-3">Title</th>
                    <th class="text-left px-5 py-3">Category</th>
                    <th class="text-left px-5 py-3">Status</th>
                    <th class="text-left px-5 py-3">Published</th>
                    <th class="text-right px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary-50">
                @forelse($posts as $post)
                    <tr>
                        <td class="px-5 py-3 font-medium text-primary-900">{{ $post->title }}</td>
                        <td class="px-5 py-3 text-ink-muted">{{ $post->category?->name ?? '—' }}</td>
                        <td class="px-5 py-3">
                            <span class="text-xs px-2 py-1 rounded-full {{ $post->status === 'published' ? 'bg-primary-50 text-primary-900' : 'bg-amber-50 text-amber-900' }}">
                                {{ ucfirst($post->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-ink-muted">{{ $post->published_at?->format('d M Y') ?? '—' }}</td>
                        <td class="px-5 py-3 text-right space-x-4">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-primary font-medium hover:underline">Edit</a>
                            <x-admin.delete-button :action="route('admin.posts.destroy', $post)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-ink-muted">No posts yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $posts->links() }}</div>
@endsection
