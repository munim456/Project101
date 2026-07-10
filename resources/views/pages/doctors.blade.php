@extends('layouts.site')

@section('title', 'Our Doctors — ' . config('app.name'))
@section('meta_description', 'Meet the qualified GPs at Cringila General Medical Practice, specialising in mental health, chronic disease, and men\'s and women\'s health.')

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
                        <x-doctor-avatar :doctor="$doctor" class="mb-4" />
                        <h2 class="font-semibold text-primary-900">{{ $doctor->name }}</h2>
                        <p class="text-accent text-sm font-medium mb-2">{{ $doctor->role }}</p>
                        <span @class([
                            'inline-block text-xs font-medium px-3 py-1 rounded-full mb-4',
                            'bg-primary-50 text-primary-900' => $doctor->status === 'Available',
                            'bg-amber-100 text-amber-800' => $doctor->status === 'On Leave',
                            'bg-gray-100 text-gray-600' => !in_array($doctor->status, ['Available', 'On Leave']),
                        ])>
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
