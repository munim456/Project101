<!DOCTYPE html>
<html lang="en" class="max-sm:scroll-pb-24">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name') . ' — GP Clinic in Cringila, NSW')</title>
    <meta name="description" content="@yield('meta_description', 'Cringila General Medical Practice — same-day appointments, walk-ins welcome, five days a week.')">

    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('meta_description', 'Cringila General Medical Practice — same-day appointments, walk-ins welcome, five days a week.')">
    <meta property="og:url" content="{{ url()->current() }}">
    @hasSection('og_image')
        <meta property="og:image" content="@yield('og_image')">
    @endif
    <meta name="twitter:card" content="summary_large_image">

    <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "MedicalClinic",
            "name": "{{ \App\Models\Setting::get('clinic_name') }}",
            "url": "{{ url('/') }}",
            "telephone": "{{ \App\Models\Setting::get('clinic_phone') }}",
            "email": "{{ \App\Models\Setting::get('clinic_email') }}",
            "address": {
                "@@type": "PostalAddress",
                "streetAddress": "{{ \App\Models\Setting::get('clinic_address') }}",
                "addressRegion": "NSW",
                "addressCountry": "AU"
            }
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head')
</head>
<body class="font-sans text-ink">

    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-50 focus:bg-white focus:px-4 focus:py-2 focus:rounded-md focus:shadow-lg">
        Skip to content
    </a>

    <header data-navbar x-data="{ mobileNav: false }" class="fixed top-0 inset-x-0 z-40 transition-all duration-300 bg-transparent">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 transition-all duration-300">
                <a href="{{ route('home') }}" class="flex items-center gap-2 font-display font-semibold text-lg text-primary-900">
                    <x-heroicon-o-plus-circle class="w-7 h-7 text-primary" />
                    {{ \App\Models\Setting::get('clinic_name', config('app.name')) }}
                </a>

                <nav class="hidden lg:flex items-center gap-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
                    <a href="{{ route('about') }}" class="hover:text-primary transition-colors">About</a>
                    <a href="{{ route('services.index') }}" class="hover:text-primary transition-colors">Services</a>
                    <a href="{{ route('doctors') }}" class="hover:text-primary transition-colors">Doctors</a>
                    <a href="{{ route('blog.index') }}" class="hover:text-primary transition-colors">Blog</a>
                    <a href="{{ route('contact') }}" class="hover:text-primary transition-colors">Contact</a>
                </nav>

                <a href="{{ route('booking') }}"
                   class="hidden sm:inline-flex items-center gap-1.5 bg-accent hover:bg-accent-dark text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition-colors shadow-sm">
                    <x-heroicon-o-calendar-days class="w-4 h-4" />
                    Book Appointment
                </a>

                <button @click="mobileNav = !mobileNav" :aria-expanded="mobileNav" class="lg:hidden p-3 -mr-3" aria-label="Toggle menu">
                    <x-heroicon-o-bars-3 class="w-6 h-6" x-show="!mobileNav" />
                    <x-heroicon-o-x-mark class="w-6 h-6" x-show="mobileNav" x-cloak />
                </button>
            </div>
        </div>

        <div x-show="mobileNav" x-cloak @click.outside="mobileNav = false"
             x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
             class="lg:hidden bg-white border-t border-primary-100 shadow-lg">
            <nav class="mx-auto max-w-7xl px-4 sm:px-6 py-2 flex flex-col text-base font-medium divide-y divide-primary-50">
                <a href="{{ route('home') }}" class="py-4 hover:text-primary transition-colors">Home</a>
                <a href="{{ route('about') }}" class="py-4 hover:text-primary transition-colors">About</a>
                <a href="{{ route('services.index') }}" class="py-4 hover:text-primary transition-colors">Services</a>
                <a href="{{ route('doctors') }}" class="py-4 hover:text-primary transition-colors">Doctors</a>
                <a href="{{ route('blog.index') }}" class="py-4 hover:text-primary transition-colors">Blog</a>
                <a href="{{ route('contact') }}" class="py-4 hover:text-primary transition-colors">Contact</a>
                <a href="{{ route('booking') }}" class="py-4 flex items-center gap-2 font-semibold text-accent">
                    <x-heroicon-o-calendar-days class="w-5 h-5" />
                    Book Appointment
                </a>
            </nav>
        </div>
    </header>

    <div class="pt-20"></div>

    <main id="main-content" class="pb-24 sm:pb-0">
        @yield('content')
    </main>

    <div class="bg-primary-900 text-primary-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14 grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <p class="font-display font-semibold text-white text-lg mb-3">{{ \App\Models\Setting::get('clinic_name') }}</p>
                <p class="text-sm text-primary-100 leading-relaxed">{{ \App\Models\Setting::get('footer_text') }}</p>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wide text-primary-200 mb-3">Quick Links</p>
                <ul class="text-sm -my-2">
                    <li><a href="{{ route('about') }}" class="inline-block py-2 hover:text-white">About</a></li>
                    <li><a href="{{ route('services.index') }}" class="inline-block py-2 hover:text-white">Services</a></li>
                    <li><a href="{{ route('doctors') }}" class="inline-block py-2 hover:text-white">Doctors</a></li>
                    <li><a href="{{ route('blog.index') }}" class="inline-block py-2 hover:text-white">Blog</a></li>
                    <li><a href="{{ route('privacy') }}" class="inline-block py-2 hover:text-white">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wide text-primary-200 mb-3">Contact</p>
                <ul class="space-y-2 text-sm text-primary-100">
                    <li>{{ \App\Models\Setting::get('clinic_address') }}</li>
                    <li>{{ \App\Models\Setting::get('clinic_phone') }}</li>
                    <li>{{ \App\Models\Setting::get('clinic_email') }}</li>
                </ul>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wide text-primary-200 mb-3">Opening Hours</p>
                <p class="text-sm text-primary-100 whitespace-pre-line">{{ \App\Models\Setting::get('opening_hours') }}</p>
            </div>
        </div>
        <div class="border-t border-primary-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-5 text-xs text-primary-200 flex flex-col sm:flex-row justify-between gap-2">
                <p>&copy; {{ now()->year }} {{ \App\Models\Setting::get('clinic_name') }}. All rights reserved.</p>
                <p>This site is not for medical emergencies. In an emergency, always call 000.</p>
            </div>
        </div>
    </div>

    <a href="{{ route('booking') }}"
       class="sm:hidden fixed bottom-4 inset-x-4 z-40 bg-accent text-white text-center font-semibold py-3 rounded-xl shadow-lg">
        Book Appointment
    </a>

    @yield('scripts')

    @if($analytics = \App\Models\Setting::get('analytics_snippet'))
        {!! $analytics !!}
    @endif
</body>
</html>
