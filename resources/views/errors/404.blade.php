@extends('layouts.site')

@section('title', 'Page Not Found — ' . config('app.name'))

@section('content')
    <section class="py-28">
        <div class="mx-auto max-w-xl px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <p class="text-accent font-bold text-sm uppercase tracking-wide mb-3">Error 404</p>
            <h1 class="text-4xl font-semibold text-primary-900 mb-4">We can't find that page.</h1>
            <p class="text-ink-muted mb-10">The page you're looking for may have moved or no longer exists. Try heading back home, or book an appointment directly.</p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 border-2 border-primary text-primary-900 font-semibold px-6 py-3.5 rounded-xl hover:bg-primary-50 transition-colors">
                    Back to Home
                </a>
                <x-booking-link class="inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3.5 rounded-xl shadow-sm transition-colors">
                    Book Appointment
                </x-booking-link>
            </div>
        </div>
    </section>
@endsection
