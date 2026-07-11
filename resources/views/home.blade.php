@extends('layouts.site')

@section('content')

    {{-- 1. HERO --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-sage-50 via-surface-muted to-primary-50">
        <x-heroicon-o-beaker class="hidden lg:block w-10 h-10 text-sage-600/25 absolute top-24 left-[8%] animate-float" aria-hidden="true" />
        <x-heroicon-o-plus-circle class="hidden lg:block w-8 h-8 text-primary/20 absolute bottom-28 left-[20%] animate-float-delayed" aria-hidden="true" />
        <x-heroicon-o-shield-check class="hidden lg:block w-9 h-9 text-sage-600/20 absolute top-16 right-[6%] animate-float-delayed" aria-hidden="true" />
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20 lg:py-28 grid lg:grid-cols-2 gap-12 items-center relative">
            <div data-aos="fade-up">
                <p class="text-accent font-bold text-sm uppercase tracking-wide mb-4">
                    {{ \App\Models\Setting::get('clinic_name') }}
                </p>
                <h1 class="text-4xl sm:text-5xl font-semibold text-primary-900 leading-tight mb-6">
                    {{ $hero['heading'] ?? 'Compassionate care, close to home.' }}
                </h1>
                <p class="text-lg text-ink-muted mb-8 max-w-lg">
                    {{ $hero['subheading'] ?? '' }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <x-booking-link class="inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3.5 rounded-xl shadow-sm transition-colors">
                        <x-heroicon-o-calendar-days class="w-5 h-5" />
                        {{ $hero['primary_button_text'] ?? 'Book Appointment' }}
                    </x-booking-link>
                    <a href="{{ route('services.index') }}"
                       class="inline-flex items-center gap-2 border-2 border-primary text-primary-900 font-semibold px-6 py-3.5 rounded-xl hover:bg-primary-50 transition-colors">
                        {{ $hero['secondary_button_text'] ?? 'Our Services' }}
                    </a>
                </div>
            </div>
            <div data-aos="fade-up" data-aos-delay="150" class="relative">
                <div class="absolute -inset-3 sm:-inset-4 bg-primary-100/70 animate-blob"></div>
                <div class="relative aspect-[4/3] rounded-3xl bg-gradient-to-br from-primary-100 to-primary-50 border border-primary-100 bg-dot-pattern overflow-hidden flex items-center justify-center">
                    <div class="relative w-28 h-28">
                        <div class="absolute inset-0 rounded-full border-2 border-primary/40 animate-pulse-ring"></div>
                        <div class="absolute inset-0 rounded-full border-2 border-primary/40 animate-pulse-ring-delayed"></div>
                        <div class="absolute inset-0 rounded-full bg-white/60 animate-pulse-soft"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <x-heroicon-o-heart class="w-14 h-14 text-primary/50" />
                        </div>
                    </div>
                </div>
                <x-ecg-line class="h-8 mt-4 text-primary/30" />
                <div class="absolute -bottom-6 -left-6 hidden sm:flex items-center gap-3 bg-white rounded-2xl shadow-lg border border-primary-100 px-5 py-4 animate-float">
                    <div class="w-11 h-11 rounded-full bg-primary-50 text-primary flex items-center justify-center flex-none">
                        <x-heroicon-o-calendar-days class="w-5 h-5" />
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-primary-900 leading-tight">Same-day appointments</p>
                        <p class="text-xs text-ink-muted">Walk-ins welcome, 5 days a week</p>
                    </div>
                </div>
                <div class="absolute -top-5 -right-3 hidden sm:flex items-center gap-2 bg-white rounded-2xl shadow-lg border border-primary-100 px-4 py-3 animate-float-delayed">
                    <div class="flex text-accent">
                        <x-heroicon-s-star class="w-3.5 h-3.5" />
                        <x-heroicon-s-star class="w-3.5 h-3.5" />
                        <x-heroicon-s-star class="w-3.5 h-3.5" />
                        <x-heroicon-s-star class="w-3.5 h-3.5" />
                        <x-heroicon-s-star class="w-3.5 h-3.5" />
                    </div>
                    <p class="text-xs font-semibold text-primary-900 whitespace-nowrap">Trusted local care</p>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 inset-x-0 leading-none" aria-hidden="true">
            <svg viewBox="0 0 1440 60" class="w-full h-10 sm:h-14" preserveAspectRatio="none">
                <path d="M0,32 C240,64 480,0 720,16 C960,32 1200,64 1440,32 L1440,60 L0,60 Z" fill="white" />
            </svg>
        </div>
    </section>

    {{-- 2. BLOG (client priority — directly after hero) --}}
    <section class="py-20 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-10" data-aos="fade-up">
                <div>
                    <p class="text-accent font-bold text-xs uppercase tracking-wide mb-2">Health &amp; Clinic News</p>
                    <h2 class="text-3xl font-semibold text-primary-900">From the blog</h2>
                </div>
                <a href="{{ route('blog.index') }}" class="text-primary font-semibold hover:underline hidden sm:inline-flex items-center gap-1">
                    View All Posts <x-heroicon-o-arrow-right class="w-4 h-4" />
                </a>
            </div>

            @if($latestPosts->isEmpty())
                <div class="rounded-2xl border border-dashed border-primary-200 p-10 text-center text-ink-muted" data-aos="fade-up">
                    <p>Blog posts will appear here once published from the admin dashboard.</p>
                </div>
            @else
                <div class="flex flex-wrap gap-6">
                    @foreach($latestPosts as $i => $post)
                        <a href="{{ route('blog.show', $post->slug) }}"
                           data-aos="fade-up" data-aos-delay="{{ $i * 75 }}"
                           class="group w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(25%-1.125rem)] rounded-2xl overflow-hidden bg-white border border-primary-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div class="aspect-video bg-primary-50 overflow-hidden">
                                @if($post->featured_image)
                                    <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}"
                                         loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <div class="p-5">
                                <p class="text-xs text-ink-muted mb-2">{{ $post->published_at?->format('d M Y') }}</p>
                                <h3 class="font-semibold text-primary-900 mb-2 leading-snug">{{ $post->title }}</h3>
                                <p class="text-sm text-ink-muted line-clamp-2">{{ $post->excerpt }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- 3. SERVICES HIGHLIGHTS --}}
    <section class="py-20 bg-sage-50 relative overflow-hidden">
        <x-illustration-molecule class="hidden lg:block w-24 h-24 absolute top-8 right-8 animate-spin-slow opacity-70" />
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-14" data-aos="fade-up">
                <p class="text-accent font-bold text-xs uppercase tracking-wide mb-2">What We Offer</p>
                <h2 class="text-3xl font-semibold text-primary-900">Services built around you</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($services as $i => $service)
                    <div data-aos="fade-up" data-aos-delay="{{ $i * 75 }}"
                         class="group rounded-2xl border border-primary-100 bg-white p-7 text-center shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <div class="w-14 h-14 rounded-xl bg-primary-50 text-primary flex items-center justify-center mx-auto mb-5 animate-pulse-soft transition-all duration-300 group-hover:bg-accent group-hover:text-white group-hover:rotate-6 group-hover:scale-110">
                            <x-dynamic-component :component="'heroicon-o-'.$service->icon" class="w-7 h-7" />
                        </div>
                        <h3 class="font-semibold text-primary-900 mb-2">{{ $service->title }}</h3>
                        <p class="text-sm text-ink-muted">{{ $service->short_description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 4. ABOUT THE PRACTICE --}}
    <section class="py-20 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-14 items-center">
            <div data-aos="fade-up" class="order-2 lg:order-1">
                <p class="text-accent font-bold text-xs uppercase tracking-wide mb-2">About Us</p>
                <h2 class="text-3xl font-semibold text-primary-900 mb-5">{{ $about['heading'] ?? 'About the Practice' }}</h2>
                <p class="text-ink-muted leading-relaxed mb-6">{{ $about['body'] ?? '' }}</p>
                <ul class="space-y-3 mb-10">
                    @foreach(($about['points'] ?? []) as $point)
                        <li class="flex items-center gap-3 text-sm font-medium text-primary-900">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-primary flex-none" />
                            {{ $point }}
                        </li>
                    @endforeach
                </ul>
                <div class="grid grid-cols-3 gap-6">
                    @foreach(($about['stats'] ?? []) as $stat)
                        <div>
                            <p class="text-3xl font-display font-semibold text-primary" data-counter="{{ $stat['value'] }}">0</p>
                            <p class="text-xs text-ink-muted mt-1">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div data-aos="fade-up" data-aos-delay="150" class="relative order-1 lg:order-2">
                <div class="absolute -inset-3 sm:-inset-4 bg-sage-100/70 animate-blob"></div>
                <div class="relative aspect-square rounded-3xl bg-gradient-to-br from-sage-50 to-white border border-primary-100 bg-dot-pattern flex items-center justify-center overflow-hidden">
                    <x-illustration-leaf class="w-28 h-28 animate-float" />
                </div>
                <div class="absolute -bottom-5 -right-4 hidden sm:flex items-center gap-3 bg-white rounded-2xl shadow-lg border border-primary-100 px-5 py-4 animate-float">
                    <div class="w-11 h-11 rounded-full bg-primary-50 text-primary flex items-center justify-center flex-none">
                        <x-heroicon-o-map-pin class="w-5 h-5" />
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-primary-900 leading-tight">Serving Cringila</p>
                        <p class="text-xs text-ink-muted">& the Wollongong community</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. DOCTORS --}}
    <section class="py-20 bg-sage-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <p class="text-accent font-bold text-xs uppercase tracking-wide mb-2">Our Team</p>
                <h2 class="text-3xl font-semibold text-primary-900">Meet our doctors</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-4xl mx-auto">
                @foreach($doctors as $i => $doctor)
                    <div data-aos="fade-up" data-aos-delay="{{ $i * 75 }}" class="text-center">
                        <x-doctor-avatar :doctor="$doctor" @class([
                            'mb-4 ring-4',
                            'ring-sage-200' => $doctor->status === 'Available',
                            'ring-amber-200' => $doctor->status === 'On Leave',
                            'ring-gray-200' => !in_array($doctor->status, ['Available', 'On Leave']),
                        ]) />
                        <h3 class="font-semibold text-primary-900">{{ $doctor->name }}</h3>
                        <p class="text-accent text-sm font-medium mb-1">{{ $doctor->role }}</p>
                        <p class="text-xs text-ink-muted mb-2">{{ $doctor->qualifications }}</p>
                        <span @class([
                            'inline-flex items-center gap-1.5 text-xs font-medium px-3 py-1 rounded-full',
                            'bg-white text-primary-900' => $doctor->status === 'Available',
                            'bg-amber-100 text-amber-800' => $doctor->status === 'On Leave',
                            'bg-gray-100 text-gray-600' => !in_array($doctor->status, ['Available', 'On Leave']),
                        ])>
                            @if($doctor->status === 'Available')
                                <span class="relative flex w-2 h-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary/60"></span>
                                    <span class="relative inline-flex rounded-full w-2 h-2 bg-primary"></span>
                                </span>
                            @endif
                            {{ $doctor->status }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 6. HEALTH NOTICES / ANNOUNCEMENTS --}}
    @if($announcements->isNotEmpty())
        <section class="py-14">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 space-y-4">
                @foreach($announcements as $announcement)
                    @include('partials.announcement')
                @endforeach
            </div>
        </section>
    @endif

    {{-- 7. TESTIMONIALS (optional) --}}
    @if($testimonials->isNotEmpty())
        <section class="py-20 bg-white">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-14" data-aos="fade-up">
                    <p class="text-accent font-bold text-xs uppercase tracking-wide mb-2">Testimonials</p>
                    <h2 class="text-3xl font-semibold text-primary-900">What our patients say</h2>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($testimonials as $i => $testimonial)
                        <div data-aos="fade-up" data-aos-delay="{{ $i * 75 }}" class="rounded-2xl border border-primary-100 border-t-4 border-t-sage-600 bg-white p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <x-heroicon-s-chat-bubble-left-right class="w-6 h-6 text-sage-600/40 mb-2" />
                            <div class="flex gap-1 text-accent mb-3">
                                @for($s = 0; $s < $testimonial->rating; $s++)
                                    <x-heroicon-s-star class="w-4 h-4" />
                                @endfor
                            </div>
                            <p class="text-sm text-ink-muted italic mb-4">&ldquo;{{ $testimonial->content }}&rdquo;</p>
                            <p class="text-sm font-semibold text-primary-900">{{ $testimonial->name }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- 8. BOOKING CTA STRIP --}}
    <section class="bg-primary py-16">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl font-semibold text-white mb-6">
                Ready to see a doctor? Book online with HealthEngine.
            </h2>
            <x-booking-link class="inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-8 py-4 rounded-xl shadow-lg transition-colors animate-pulse-glow">
                <x-heroicon-o-calendar-days class="w-5 h-5" />
                Book Appointment
            </x-booking-link>
        </div>
    </section>

@endsection
