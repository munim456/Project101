@extends('layouts.site')

@section('title', 'Our Doctors — ' . config('app.name'))

@section('content')
    <section class="py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <p class="text-accent font-bold text-xs uppercase tracking-wide mb-2">Our Team</p>
                <h1 class="text-4xl font-semibold text-primary-900">Meet our doctors</h1>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($doctors as $i => $doctor)
                    <div data-aos="fade-up" data-aos-delay="{{ $i * 75 }}" class="text-center">
                        <div class="aspect-square rounded-2xl bg-primary-50 mb-4 flex items-center justify-center">
                            <x-heroicon-o-user class="w-16 h-16 text-primary/30" />
                        </div>
                        <h2 class="font-semibold text-primary-900">{{ $doctor->name }}</h2>
                        <p class="text-accent text-sm font-medium mb-1">{{ $doctor->role }}</p>
                        <p class="text-xs text-ink-muted mb-3">{{ $doctor->qualifications }}</p>
                        <p class="text-sm text-ink-muted">{{ $doctor->bio }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
