<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('favicon-32.png') }}" type="image/png" sizes="32x32">
    <title>@yield('title', 'Admin') — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head')
</head>
<body class="font-sans text-ink bg-surface-muted" x-data="{ sidebarOpen: false }">

    <div class="lg:hidden flex items-center justify-between px-4 h-16 bg-white border-b border-primary-100">
        <span class="font-display font-semibold text-primary-900">Admin</span>
        <button @click="sidebarOpen = !sidebarOpen" class="p-2"><x-heroicon-o-bars-3 class="w-6 h-6" /></button>
    </div>

    <div class="lg:flex">
        <aside :class="sidebarOpen ? 'block' : 'hidden'" class="lg:block w-full lg:w-64 flex-none bg-primary-900 text-primary-50 min-h-screen lg:min-h-screen">
            <div class="p-6">
                <a href="{{ route('admin.dashboard') }}" class="font-display font-semibold text-lg text-white flex items-center gap-2 mb-8">
                    <x-heroicon-o-plus-circle class="w-6 h-6" />
                    CGMP Admin
                </a>

                <nav class="space-y-1 text-sm">
                    @php
                        $navItems = [
                            ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'squares-2x2'],
                            ['route' => 'admin.sections.edit', 'label' => 'Hero & About', 'icon' => 'photo', 'params' => ['hero']],
                            ['route' => 'admin.services.index', 'label' => 'Services', 'icon' => 'heart'],
                            ['route' => 'admin.doctors.index', 'label' => 'Doctors', 'icon' => 'user-group'],
                            ['route' => 'admin.posts.index', 'label' => 'Blog Posts', 'icon' => 'newspaper'],
                            ['route' => 'admin.announcements.index', 'label' => 'Announcements', 'icon' => 'megaphone'],
                            ['route' => 'admin.testimonials.index', 'label' => 'Testimonials', 'icon' => 'star'],
                            ['route' => 'admin.pages.index', 'label' => 'Pages', 'icon' => 'document-text'],
                            ['route' => 'admin.contact-messages.index', 'label' => 'Contact Submissions', 'icon' => 'envelope'],
                            ['route' => 'admin.media.index', 'label' => 'Media Library', 'icon' => 'photo'],
                            ['route' => 'admin.settings.edit', 'label' => 'Site Settings', 'icon' => 'cog-6-tooth'],
                        ];
                    @endphp

                    @foreach($navItems as $item)
                        <a href="{{ route($item['route'], $item['params'] ?? []) }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs(explode('.edit', $item['route'])[0].'*') || request()->routeIs($item['route']) ? 'bg-primary-800 text-white' : 'text-primary-100 hover:bg-primary-800/60' }}">
                            <x-dynamic-component :component="'heroicon-o-'.$item['icon']" class="w-5 h-5" />
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>
            </div>

            <div class="p-6 border-t border-primary-800 mt-4 space-y-3">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 text-sm text-primary-100 hover:text-white">
                    <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4" /> View Live Site
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-sm text-primary-100 hover:text-white">
                        <x-heroicon-o-arrow-left-on-rectangle class="w-4 h-4" /> Log Out
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 min-w-0">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 py-10">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-2xl font-display font-semibold text-primary-900">@yield('heading', 'Dashboard')</h1>
                        @hasSection('subheading')
                            <p class="text-sm text-ink-muted mt-1">@yield('subheading')</p>
                        @endif
                    </div>
                    @hasSection('actions')
                        <div>@yield('actions')</div>
                    @endif
                </div>

                @if(session('status'))
                    <div class="rounded-xl bg-primary-50 border border-primary-100 text-primary-900 text-sm p-4 mb-6">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @yield('scripts')
</body>
</html>
