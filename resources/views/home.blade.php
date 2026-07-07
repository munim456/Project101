@extends('layouts.site')

@section('content')

    {{-- 1. HERO --}}
    <section class="relative overflow-hidden bg-surface-muted">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20 lg:py-28 grid lg:grid-cols-2 gap-12 items-center">
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
                    <a href="{{ route('booking') }}"
                       class="inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3.5 rounded-xl shadow-sm transition-colors">
                        <x-heroicon-o-calendar-days class="w-5 h-5" />
                        {{ $hero['primary_button_text'] ?? 'Book Appointment' }}
                    </a>
                    <a href="{{ route('services.index') }}"
                       class="inline-flex items-center gap-2 border-2 border-primary text-primary-900 font-semibold px-6 py-3.5 rounded-xl hover:bg-primary-50 transition-colors">
                        {{ $hero['secondary_button_text'] ?? 'Our Services' }}
                    </a>
                </div>
            </div>
            <div data-aos="fade-up" data-aos-delay="150" class="relative">
                <div class="aspect-[4/3] rounded-3xl bg-gradient-to-br from-primary-100 to-primary-50 border border-primary-100 flex items-center justify-center">
                    <x-heroicon-o-heart class="w-24 h-24 text-primary/30" />
                </div>
            </div>
        </div>
    </section>

    {{-- 2. BLOG (client priority — directly after hero) --}}
    <section class="py-20">
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
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($latestPosts as $i => $post)
                        <a href="{{ route('blog.show', $post->slug) }}"
                           data-aos="fade-up" data-aos-delay="{{ $i * 75 }}"
                           class="group rounded-2xl overflow-hidden bg-white border border-primary-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
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
    <section class="py-20 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <p class="text-accent font-bold text-xs uppercase tracking-wide mb-2">What We Offer</p>
                <h2 class="text-3xl font-semibold text-primary-900">Services built around you</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($services as $i => $service)
                    <div data-aos="fade-up" data-aos-delay="{{ $i * 75 }}"
                         class="rounded-2xl border border-primary-100 p-7 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <div class="w-14 h-14 rounded-xl bg-primary-50 text-primary flex items-center justify-center mx-auto mb-5">
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
    <section class="py-20">
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
            <div data-aos="fade-up" data-aos-delay="150" class="order-1 lg:order-2">
                <div class="aspect-square rounded-3xl bg-gradient-to-br from-primary-50 to-white border border-primary-100"></div>
            </div>
        </div>
    </section>

    {{-- 5. DOCTORS --}}
    <section class="py-20 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <p class="text-accent font-bold text-xs uppercase tracking-wide mb-2">Our Team</p>
                <h2 class="text-3xl font-semibold text-primary-900">Meet our doctors</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-4xl mx-auto">
                @foreach($doctors as $i => $doctor)
                    <div data-aos="fade-up" data-aos-delay="{{ $i * 75 }}" class="text-center">
                        <div class="aspect-square rounded-2xl bg-primary-50 mb-4 flex items-center justify-center">
                            <x-heroicon-o-user class="w-16 h-16 text-primary/30" />
                        </div>
                        <h3 class="font-semibold text-primary-900">{{ $doctor->name }}</h3>
                        <p class="text-accent text-sm font-medium mb-1">{{ $doctor->role }}</p>
                        <p class="text-xs text-ink-muted">{{ $doctor->qualifications }}</p>
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
                        <div data-aos="fade-up" data-aos-delay="{{ $i * 75 }}" class="rounded-2xl border border-primary-100 p-6">
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
            <a href="{{ route('booking') }}"
               class="inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-8 py-4 rounded-xl shadow-lg transition-colors">
                <x-heroicon-o-calendar-days class="w-5 h-5" />
                Book Appointment
            </a>
        </div>
    </section>

@endsection
