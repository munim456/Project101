@extends('layouts.site')

@section('title', $page->meta_title ?: $page->title . ' — ' . config('app.name'))
@section('meta_description', $page->meta_description ?? '')

@section('content')
    <section class="py-20">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-semibold text-primary-900 mb-8" data-aos="fade-up">{{ $page->title }}</h1>
            <div class="prose prose-lg max-w-none text-ink-muted leading-relaxed" data-aos="fade-up">
                {!! $page->body !!}
            </div>
        </div>
    </section>
@endsection
