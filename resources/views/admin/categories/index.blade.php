@extends('layouts.admin')

@section('title', 'Blog Categories')
@section('heading', 'Blog Categories')
@section('subheading', 'Used to organise and filter blog posts.')
@section('actions')
    <a href="{{ route('admin.posts.index') }}" class="text-sm text-primary font-medium hover:underline">← Back to Posts</a>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.categories.store') }}"
          class="mb-6 bg-white border border-primary-100 rounded-2xl p-6 flex items-end gap-4">
        @csrf
        <div class="flex-1">
            <label for="name" class="block text-sm font-medium text-primary-900 mb-1.5">New category name</label>
            <input type="text" id="name" name="name" required
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </div>
        <button type="submit" class="bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-2.5 rounded-lg">Add</button>
    </form>

    <div class="rounded-2xl border border-primary-100 bg-white overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-primary-50 text-primary-900 text-xs uppercase tracking-wide">
                <tr>
                    <th class="text-left px-5 py-3">Name</th>
                    <th class="text-left px-5 py-3">Posts</th>
                    <th class="text-right px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary-50">
                @forelse($categories as $category)
                    <tr x-data="{ editing: false }">
                        <td class="px-5 py-3">
                            <span x-show="!editing" class="font-medium text-primary-900">{{ $category->name }}</span>
                            <form x-show="editing" method="POST" action="{{ route('admin.categories.update', $category) }}" class="flex gap-2">
                                @csrf @method('PUT')
                                <input type="text" name="name" value="{{ $category->name }}" class="rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-sm py-1">
                                <button type="submit" class="text-primary text-sm font-medium">Save</button>
                            </form>
                        </td>
                        <td class="px-5 py-3 text-ink-muted">{{ $category->posts_count }}</td>
                        <td class="px-5 py-3 text-right space-x-4">
                            <button @click="editing = !editing" class="text-primary font-medium text-sm">Edit</button>
                            <x-admin.delete-button :action="route('admin.categories.destroy', $category)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-5 py-8 text-center text-ink-muted">No categories yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
