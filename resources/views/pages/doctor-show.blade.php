@extends('layouts.site')

@section('title', $doctor->name . ' — ' . config('app.name'))
@section('meta_description', $doctor->role . ' at ' . config('app.name') . '. ' . \Illuminate\Support\Str::limit($doctor->bio, 140))

@section('content')
    <section class="py-20">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <a href="{{ route('doctors') }}" class="inline-flex items-center gap-1.5 text-sm text-ink-muted hover:text-primary mb-8">
                <x-heroicon-o-arrow-left class="w-4 h-4" />
                Back to Doctors
            </a>

            <div class="grid sm:grid-cols-[220px_1fr] gap-8 items-start" data-aos="fade-up">
                <x-doctor-avatar :doctor="$doctor" />

                <div>
                    <h1 class="text-3xl font-semibold text-primary-900 mb-1">{{ $doctor->name }}</h1>
                    <p class="text-accent font-medium mb-3">{{ $doctor->role }}</p>

                    <span @class([
                        'inline-block text-xs font-medium px-3 py-1 rounded-full mb-4',
                        'bg-primary-50 text-primary-900' => $doctor->status === 'Available',
                        'bg-amber-100 text-amber-800' => $doctor->status === 'On Leave',
                        'bg-gray-100 text-gray-600' => !in_array($doctor->status, ['Available', 'On Leave']),
                    ])>
                        {{ $doctor->status }}
                    </span>

                    @if($doctor->qualifications)
                        <p class="text-sm text-ink-muted mb-4">{{ $doctor->qualifications }}</p>
                    @endif

                    @if($doctor->bio)
                        <div class="prose max-w-none text-ink-muted leading-relaxed">
                            <p>{{ $doctor->bio }}</p>
                        </div>
                    @endif

                    <x-booking-link class="inline-flex items-center gap-2 mt-8 bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3.5 rounded-xl shadow-sm transition-colors">
                        <x-heroicon-o-calendar-days class="w-5 h-5" />
                        Book Appointment
                    </x-booking-link>
                </div>
            </div>
        </div>
    </section>
@endsection
