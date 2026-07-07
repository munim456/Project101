@extends('layouts.site')

@section('title', 'Blog — ' . config('app.name'))

@section('content')
    <section class="py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10" data-aos="fade-up">
                <p class="text-accent font-bold text-xs uppercase tracking-wide mb-2">Health &amp; Clinic News</p>
                <h1 class="text-4xl font-semibold text-primary-900">Blog</h1>
            </div>

            <form method="GET" class="max-w-md mx-auto mb-12 flex gap-2" data-aos="fade-up">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Search posts…"
                       class="flex-1 rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
                <button type="submit" class="bg-primary text-white px-4 rounded-lg font-semibold">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                </button>
            </form>

            @if($posts->isEmpty())
                <div class="rounded-2xl border border-dashed border-primary-200 p-16 text-center text-ink-muted" data-aos="fade-up">
                    <p>No posts published yet — check back soon.</p>
                </div>
            @else
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @foreach($posts as $i => $post)
                        <a href="{{ route('blog.show', $post->slug) }}"
                           data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 75 }}"
                           class="group rounded-2xl overflow-hidden bg-white border border-primary-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div class="aspect-video bg-primary-50 overflow-hidden">
                                @if($post->featured_image)
                                    <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}"
                                         loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <div class="p-5">
                                <p class="text-xs text-ink-muted mb-2">{{ $post->published_at?->format('d M Y') }}</p>
                                <h2 class="font-semibold text-primary-900 mb-2 leading-snug">{{ $post->title }}</h2>
                                <p class="text-sm text-ink-muted line-clamp-2">{{ $post->excerpt }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                {{ $posts->links() }}
            @endif
        </div>
    </section>
@endsection
