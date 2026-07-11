@extends('layouts.site')

@section('title', 'Our Doctors — ' . config('app.name'))
@section('meta_description', 'Meet the qualified GPs at Cringila General Medical Practice, specialising in mental health, chronic disease, and men\'s and women\'s health.')

@section('content')
    <section class="py-20 bg-sage-50 relative overflow-hidden">
        <x-illustration-molecule class="hidden lg:block w-20 h-20 absolute top-10 right-10 animate-spin-slow opacity-60" />
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-14" data-aos="fade-up">
                <p class="text-accent font-bold text-xs uppercase tracking-wide mb-2">Our Team</p>
                <h1 class="text-4xl font-semibold text-primary-900">Meet our doctors</h1>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($doctors as $i => $doctor)
                    <div data-aos="fade-up" data-aos-delay="{{ $i * 75 }}" class="text-center bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300">
                        <x-doctor-avatar :doctor="$doctor" class="mb-4" />
                        <h2 class="font-semibold text-primary-900">{{ $doctor->name }}</h2>
                        <p class="text-accent text-sm font-medium mb-2">{{ $doctor->role }}</p>
                        <span @class([
                            'inline-flex items-center gap-1.5 text-xs font-medium px-3 py-1 rounded-full mb-4',
                            'bg-primary-50 text-primary-900' => $doctor->status === 'Available',
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
                        <div>
                            <a href="{{ route('doctors.show', $doctor) }}"
                               class="inline-flex items-center gap-1.5 text-primary font-semibold text-sm hover:text-primary-dark">
                                Get Details
                                <x-heroicon-o-arrow-right class="w-4 h-4" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
