@extends('layouts.site')

@section('title', 'Book Appointment — ' . config('app.name'))
@section('meta_description', 'Book a GP appointment online with Cringila General Medical Practice via HealthEngine, or call to book by phone. Walk-ins welcome.')

@section('content')
    <section class="py-12 lg:py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-[320px_1fr] rounded-2xl overflow-hidden shadow-lg border border-primary-100" data-aos="fade-up">

                {{-- LEFT: Static Information Panel --}}
                <div class="bg-primary-900 text-white p-8 flex flex-col">
                    <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center mb-6">
                        <x-heroicon-o-calendar-days class="w-6 h-6" />
                    </div>

                    <h1 class="text-2xl font-semibold mb-1">Book appointment</h1>
                    <p class="text-sm text-primary-100 mb-8">{{ \App\Models\Setting::get('clinic_name') }}</p>
                    <p class="text-sm text-primary-100">Bookings are handled securely through HealthEngine — select a date and practitioner in the panel to see live availability.</p>

                    <div class="mt-auto pt-6 border-t border-white/10 text-sm text-primary-100 space-y-3">
                        <p class="font-semibold text-white">Payment &amp; booking info</p>
                        <p>Please bring your Medicare card to your appointment. Bulk billing terms and any private fees will be confirmed when your booking is made.</p>
                        <p>Prefer to book by phone or walk in? Call us on <span class="text-white font-medium">{{ $clinicPhone }}</span> — walk-ins are always welcome.</p>
                    </div>
                </div>

                {{-- RIGHT: HealthEngine Booking Panel --}}
                <div class="bg-white p-6 sm:p-8">
                    @if($healthengineEmbedCode)
                        <div class="rounded-xl border border-primary-100 overflow-hidden [&_iframe]:w-full [&_iframe]:min-h-[600px]">
                            {!! $healthengineEmbedCode !!}
                        </div>
                        @if($healthengineUrl)
                            <div class="text-center mt-6">
                                <a href="{{ $healthengineUrl }}" target="_blank" rel="noopener"
                                   class="inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3.5 rounded-xl shadow-sm transition-colors">
                                    Open Booking in a New Tab
                                    <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4" />
                                </a>
                            </div>
                        @endif
                    @elseif($healthengineUrl)
                        <div class="rounded-xl border border-primary-100 overflow-hidden">
                            <div class="aspect-[4/3] sm:aspect-video">
                                <iframe src="{{ $healthengineUrl }}" title="HealthEngine booking widget"
                                        class="w-full h-full" loading="lazy"></iframe>
                            </div>
                        </div>
                        <div class="text-center mt-6">
                            <a href="{{ $healthengineUrl }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3.5 rounded-xl shadow-sm transition-colors">
                                Open Booking in a New Tab
                                <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4" />
                            </a>
                        </div>
                    @else
                        <div class="h-full rounded-xl border border-dashed border-primary-200 p-10 text-center text-ink-muted flex items-center justify-center">
                            Online booking will be available here shortly — the HealthEngine link can be set from the admin dashboard.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
