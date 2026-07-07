@extends('layouts.site')

@section('title', 'Book Appointment — ' . config('app.name'))
@section('meta_description', 'Book a GP appointment online with Cringila General Medical Practice via HealthEngine, or call to book by phone. Walk-ins welcome.')

@section('content')
    <section class="py-20">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10" data-aos="fade-up">
                <p class="text-accent font-bold text-xs uppercase tracking-wide mb-2">Appointments</p>
                <h1 class="text-4xl font-semibold text-primary-900 mb-4">Book an Appointment</h1>
                <p class="text-ink-muted">Bookings are handled securely through HealthEngine.</p>
            </div>

            @if($healthengineUrl)
                <div class="rounded-2xl border border-primary-100 overflow-hidden mb-8" data-aos="fade-up">
                    <div class="aspect-[4/3] sm:aspect-video">
                        <iframe src="{{ $healthengineUrl }}" title="HealthEngine booking widget"
                                class="w-full h-full" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="text-center" data-aos="fade-up">
                    <a href="{{ $healthengineUrl }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3.5 rounded-xl shadow-sm transition-colors">
                        Open Booking in a New Tab
                        <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4" />
                    </a>
                </div>
            @else
                <div class="rounded-2xl border border-dashed border-primary-200 p-10 text-center text-ink-muted" data-aos="fade-up">
                    Online booking will be available here shortly — the HealthEngine link can be set from the admin dashboard.
                </div>
            @endif

            <div class="mt-12 rounded-2xl bg-primary-50 p-8 text-center" data-aos="fade-up">
                <p class="font-semibold text-primary-900 mb-1">Prefer to book by phone or walk in?</p>
                <p class="text-ink-muted text-sm mb-3">Call us on {{ $clinicPhone }} — walk-ins are always welcome.</p>
            </div>
        </div>
    </section>
@endsection
