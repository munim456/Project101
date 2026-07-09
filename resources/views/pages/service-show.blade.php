@extends('layouts.site')

@section('title', $service->title . ' — ' . config('app.name'))
@section('meta_description', $service->short_description)

@section('content')
    <section class="py-20">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="w-16 h-16 rounded-xl bg-primary-50 text-primary flex items-center justify-center mb-6" data-aos="fade-up">
                <x-dynamic-component :component="'heroicon-o-'.$service->icon" class="w-8 h-8" />
            </div>
            <h1 class="text-4xl font-semibold text-primary-900 mb-6" data-aos="fade-up">{{ $service->title }}</h1>
            <div class="prose prose-lg max-w-none text-ink-muted leading-relaxed" data-aos="fade-up">
                <p>{{ $service->description }}</p>
            </div>
            <x-booking-link class="inline-flex items-center gap-2 mt-10 bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3.5 rounded-xl shadow-sm transition-colors">
                <x-heroicon-o-calendar-days class="w-5 h-5" />
                Book Appointment
            </x-booking-link>
        </div>
    </section>
@endsection
