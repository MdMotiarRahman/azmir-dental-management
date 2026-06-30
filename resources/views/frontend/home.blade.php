@extends('layouts.frontend')

@section('title', 'Azmeer Dental Care — Professional Dental Care Service')

@section('content')

{{-- Hero --}}
<section class="relative bg-gray-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1606811971618-4486d14f3f99?w=1600&q=80" alt="Dental clinic" class="w-full h-full object-cover opacity-40">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
        <div class="max-w-xl">
            <h1 class="text-4xl md:text-5xl lg:text-[3.5rem] font-display font-bold text-white leading-[1.15] mb-3">
                Azmeer Dental Care
            </h1>
            <p class="text-xl text-primary-300 font-medium mb-4">
                Professional Dental Care Service
            </p>
            <p class="text-lg text-gray-300 mb-2 leading-relaxed">
                Dr. Sher Shah, BDS — Dental Surgeon
            </p>
            <p class="text-sm text-gray-400 mb-8">
                BMDC Reg. No: 10448 · Patgram Road, Jamalpur
            </p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="tel:{{ $contactInfo->phone ?? '' }}" class="bg-primary-600 text-white px-7 py-3.5 text-sm font-semibold rounded-lg hover:bg-primary-700 transition text-center inline-flex items-center justify-center gap-2">
                    <i class="fas fa-phone text-xs"></i>
                    Book Appointment: {{ $contactInfo->phone ?? '' }}
                </a>
                <a href="{{ route('appointment.create') }}" class="border border-white/30 text-white px-7 py-3.5 text-sm font-semibold rounded-lg hover:bg-white/10 transition text-center">
                    Request Online
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Visiting Hours Bar --}}
<section class="bg-primary-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
        <div class="flex flex-col md:flex-row items-center justify-center gap-6 md:gap-12 text-sm">
            <div class="flex items-center gap-2">
                <i class="fas fa-clock text-primary-200"></i>
                <span><strong>Morning:</strong> 10:00 AM – 2:00 PM</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-clock text-primary-200"></i>
                <span><strong>Evening:</strong> 4:00 PM – 8:00 PM</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-calendar-check text-primary-200"></i>
                <span><strong>Appointment:</strong> {{ $contactInfo->phone ?? '01638209228' }}</span>
            </div>
        </div>
    </div>
</section>

{{-- Services --}}
@if($services->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-12">
            <div>
                <p class="text-primary-600 text-sm font-semibold uppercase tracking-wide mb-2">What We Offer</p>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900">Our Services</h2>
            </div>
            <a href="{{ route('services.index') }}" class="text-primary-600 text-sm font-semibold hover:text-primary-700 mt-4 md:mt-0 inline-flex items-center gap-1.5">
                View all services <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($services as $service)
                <a href="{{ route('services.show', $service) }}" class="group bg-white rounded-xl p-7 border border-gray-100 hover:border-primary-200 hover:shadow-md transition-all duration-200">
                    <div class="w-12 h-12 bg-primary-50 rounded-lg flex items-center justify-center mb-5 group-hover:bg-primary-600 transition">
                        <i class="{{ $service->icon ?? 'fas fa-tooth' }} text-primary-600 text-lg group-hover:text-white transition"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $service->title }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ Str::limit($service->description, 120) }}</p>
                    <span class="inline-flex items-center gap-1 text-primary-600 text-sm font-medium mt-4 opacity-0 group-hover:opacity-100 transition">
                        Learn more <i class="fas fa-arrow-right text-xs"></i>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- About the Doctor --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <p class="text-primary-600 text-sm font-semibold uppercase tracking-wide mb-2">About the Doctor</p>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mb-6">Dr. Sher Shah, BDS</h2>
                <p class="text-gray-500 leading-relaxed mb-6">
                    Dr. Sher Shah is a registered Dental Surgeon with the Bangladesh Medical and Dental Council (BMDC Reg. No: 10448). He holds a Bachelor of Dental Surgery degree from Sylhet MAG Osmani Medical College and Mymensingh Medical College.
                </p>
                <p class="text-gray-500 leading-relaxed mb-8">
                    At Azmeer Dental Care, Dr. Shah provides comprehensive dental services — from routine check-ups and oral care to advanced dental treatments and surgical procedures — ensuring every patient receives personalized, quality care.
                </p>
                <div class="space-y-4 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-primary-600 text-xs"></i>
                        </div>
                        <span class="text-sm text-gray-700">BMDC Registered (Reg. No: 10448)</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-primary-600 text-xs"></i>
                        </div>
                        <span class="text-sm text-gray-700">BDS — Sylhet MAG Osmani Medical College</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-primary-600 text-xs"></i>
                        </div>
                        <span class="text-sm text-gray-700">Trusted dental care in Jamalpur</span>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="text-primary-600 text-sm font-semibold hover:text-primary-700 inline-flex items-center gap-1.5">
                    Read more about us <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=800&q=80" alt="Dental treatment" class="rounded-2xl shadow-lg w-full">
            </div>
        </div>
    </div>
</section>

{{-- Doctors --}}
@if($doctors->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-12">
            <div>
                <p class="text-primary-600 text-sm font-semibold uppercase tracking-wide mb-2">Meet the Doctor</p>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900">Our Dentist</h2>
            </div>
            <a href="{{ route('doctors.index') }}" class="text-primary-600 text-sm font-semibold hover:text-primary-700 mt-4 md:mt-0 inline-flex items-center gap-1.5">
                View full profile <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($doctors as $doctor)
                <a href="{{ route('doctors.show', $doctor) }}" class="group bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-md transition-all duration-200">
                    <div class="h-56 bg-gray-100 overflow-hidden">
                        @if($doctor->photo)
                            <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-primary-50">
                                <i class="fas fa-user-doctor text-primary-200 text-5xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-gray-900 group-hover:text-primary-600 transition">{{ $doctor->name }}</h3>
                        <p class="text-sm text-primary-600 font-medium">{{ $doctor->specialization }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $doctor->qualification }} · BMDC Reg. {{ $doctor->registration_number }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="relative bg-primary-700 overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-white mb-2">Need a Dental Appointment?</h2>
                <p class="text-primary-100 text-sm max-w-lg">
                    Call us at {{ $contactInfo->phone ?? '01638209228' }} or visit us at Patgram Road, Jamalpur. Morning and evening appointments available.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 flex-shrink-0">
                <a href="tel:{{ $contactInfo->phone ?? '' }}" class="bg-white text-primary-700 px-8 py-3.5 text-sm font-semibold rounded-lg hover:bg-gray-50 transition text-center inline-flex items-center justify-center gap-2">
                    <i class="fas fa-phone text-xs"></i>
                    Call Now
                </a>
                <a href="{{ route('contact.index') }}" class="border border-white/40 text-white px-8 py-3.5 text-sm font-semibold rounded-lg hover:bg-white/10 transition text-center">
                    Get Directions
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
