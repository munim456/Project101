@extends('layouts.site')

@section('title', 'Services — ' . config('app.name'))

@section('content')
    <section class="py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <p class="text-accent font-bold text-xs uppercase tracking-wide mb-2">What We Offer</p>
                <h1 class="text-4xl font-semibold text-primary-900">Our Services</h1>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $i => $service)
                    <a href="{{ route('services.show', $service->slug) }}"
                       data-aos="fade-up" data-aos-delay="{{ $i * 75 }}"
                       class="block rounded-2xl border border-primary-100 p-7 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <div class="w-14 h-14 rounded-xl bg-primary-50 text-primary flex items-center justify-center mb-5">
                            <x-dynamic-component :component="'heroicon-o-'.$service->icon" class="w-7 h-7" />
                        </div>
                        <h2 class="font-semibold text-primary-900 mb-2">{{ $service->title }}</h2>
                        <p class="text-sm text-ink-muted">{{ $service->short_description }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
