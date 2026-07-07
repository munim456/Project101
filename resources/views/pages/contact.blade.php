@extends('layouts.site')

@section('title', 'Contact Us — ' . config('app.name'))

@section('content')
    <section class="py-20">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-14">
            <div data-aos="fade-up">
                <p class="text-accent font-bold text-xs uppercase tracking-wide mb-2">Get in Touch</p>
                <h1 class="text-4xl font-semibold text-primary-900 mb-6">Contact Us</h1>

                <div class="rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-sm p-4 mb-8 flex gap-3">
                    <x-heroicon-o-exclamation-triangle class="w-5 h-5 flex-none" />
                    <p>This form is not for medical advice or emergencies. If this is a medical emergency, call <strong>000</strong> immediately.</p>
                </div>

                @if(session('status'))
                    <div class="rounded-xl bg-primary-50 border border-primary-100 text-primary-900 text-sm p-4 mb-8">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-primary-900 mb-1.5">Full name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label for="email" class="block text-sm font-medium text-primary-900 mb-1.5">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
                            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-primary-900 mb-1.5">Phone (optional)</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
                        </div>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-primary-900 mb-1.5">Message</label>
                        <textarea id="message" name="message" rows="5" required
                                  class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">{{ old('message') }}</textarea>
                        @error('message') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit"
                            class="inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3.5 rounded-xl shadow-sm transition-colors">
                        Send Message
                    </button>
                </form>
            </div>

            <div data-aos="fade-up" data-aos-delay="150" class="space-y-6">
                <div class="rounded-2xl border border-primary-100 p-6">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-muted mb-3">Address</p>
                    <p class="text-primary-900 font-medium">{{ \App\Models\Setting::get('clinic_address') }}</p>
                </div>
                <div class="rounded-2xl border border-primary-100 p-6">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-muted mb-3">Phone &amp; Email</p>
                    <p class="text-primary-900 font-medium">{{ \App\Models\Setting::get('clinic_phone') }}</p>
                    <p class="text-primary-900 font-medium">{{ \App\Models\Setting::get('clinic_email') }}</p>
                </div>
                <div class="rounded-2xl border border-primary-100 p-6">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-muted mb-3">Opening Hours</p>
                    <p class="text-primary-900 font-medium whitespace-pre-line">{{ \App\Models\Setting::get('opening_hours') }}</p>
                </div>
                @if($map = \App\Models\Setting::get('google_map_embed'))
                    <div class="rounded-2xl overflow-hidden border border-primary-100 aspect-video">
                        {!! $map !!}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
