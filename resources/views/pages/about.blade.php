@extends('layouts.site')

@section('title', 'About Us — ' . config('app.name'))
@section('meta_description', 'Meet the GPs at Cringila General Medical Practice — same-day appointments, walk-ins welcome, five days a week.')

@section('content')
    <section class="py-20">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <p class="text-accent font-bold text-xs uppercase tracking-wide mb-2">About Us</p>
                <h1 class="text-4xl font-semibold text-primary-900">{{ $about['heading'] ?? 'About the Practice' }}</h1>
            </div>
            <div class="prose prose-lg max-w-none text-ink-muted leading-relaxed mb-16" data-aos="fade-up">
                <p>{{ $about['body'] ?? '' }}</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up">
                @foreach($doctors as $doctor)
                    <div class="text-center">
                        <div class="aspect-square rounded-2xl bg-primary-50 mb-4 flex items-center justify-center">
                            <x-heroicon-o-user class="w-16 h-16 text-primary/30" />
                        </div>
                        <h3 class="font-semibold text-primary-900">{{ $doctor->name }}</h3>
                        <p class="text-accent text-sm font-medium mb-1">{{ $doctor->role }}</p>
                        <p class="text-xs text-ink-muted mb-3">{{ $doctor->qualifications }}</p>
                        <p class="text-sm text-ink-muted">{{ $doctor->bio }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
