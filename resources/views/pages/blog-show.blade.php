@extends('layouts.site')

@section('title', ($post->meta_title ?: $post->title) . ' — ' . config('app.name'))
@section('meta_description', $post->meta_description ?? $post->excerpt)

@section('content')
    <article class="py-20">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <p class="text-accent font-bold text-xs uppercase tracking-wide mb-3" data-aos="fade-up">
                {{ $post->category?->name ?? 'Health News' }} &middot; {{ $post->published_at?->format('d M Y') }}
            </p>
            <h1 class="text-4xl font-semibold text-primary-900 mb-8" data-aos="fade-up">{{ $post->title }}</h1>

            @if($post->featured_image)
                <div class="aspect-video rounded-2xl overflow-hidden bg-primary-50 mb-10" data-aos="fade-up">
                    <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="prose prose-lg max-w-none text-ink-muted leading-relaxed mb-12" data-aos="fade-up">
                {!! $post->body !!}
            </div>

            <div class="flex items-center gap-3 mb-16 pb-10 border-b border-primary-100" data-aos="fade-up">
                <span class="text-sm font-semibold text-primary-900">Share:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener"
                   class="text-primary hover:text-primary-dark"><x-heroicon-o-share class="w-5 h-5" /></a>
            </div>

            @if($related->isNotEmpty())
                <h2 class="text-2xl font-semibold text-primary-900 mb-6" data-aos="fade-up">Related posts</h2>
                <div class="grid sm:grid-cols-3 gap-6">
                    @foreach($related as $relatedPost)
                        <a href="{{ route('blog.show', $relatedPost->slug) }}" class="block group" data-aos="fade-up">
                            <div class="aspect-video rounded-xl bg-primary-50 mb-3 overflow-hidden">
                                @if($relatedPost->featured_image)
                                    <img src="{{ asset('storage/'.$relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <p class="font-semibold text-primary-900 text-sm">{{ $relatedPost->title }}</p>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </article>
@endsection
