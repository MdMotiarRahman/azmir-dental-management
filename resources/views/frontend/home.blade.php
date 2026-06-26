@extends('layouts.frontend')

@section('title', 'SmileCare Dental Clinic — Trusted Dental Care')

@section('content')

{{-- Hero --}}
<section class="relative bg-gray-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1606811971618-4486d14f3f99?w=1600&q=80" alt="Dental clinic" class="w-full h-full object-cover opacity-40">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
        <div class="max-w-xl">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm text-white/90 text-xs font-medium px-3 py-1.5 rounded-full mb-6">
                <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full"></span>
                Accepting New Patients
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-[3.5rem] font-display font-bold text-white leading-[1.15] mb-5">
                A Healthy Smile<br>Starts Here
            </h1>
            <p class="text-lg text-gray-300 mb-8 leading-relaxed max-w-md">
                Family-friendly dental care in a comfortable setting. From routine check-ups to advanced treatments, we keep your smile at its best.
            </p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('appointment.create') }}" class="bg-primary-600 text-white px-7 py-3.5 text-sm font-semibold rounded-lg hover:bg-primary-700 transition text-center">
                    Schedule a Visit
                </a>
                <a href="tel:{{ $contactInfo->phone ?? '' }}" class="border border-white/30 text-white px-7 py-3.5 text-sm font-semibold rounded-lg hover:bg-white/10 transition text-center inline-flex items-center justify-center gap-2">
                    <i class="fas fa-phone text-xs"></i>
                    {{ $contactInfo->phone ?? 'Call Us' }}
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Trust Bar --}}
<section class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-100">
            <div class="py-8 px-6 text-center">
                <p class="text-3xl font-bold text-gray-900">15+</p>
                <p class="text-sm text-gray-500 mt-1">Years of Practice</p>
            </div>
            <div class="py-8 px-6 text-center">
                <p class="text-3xl font-bold text-gray-900">12,000+</p>
                <p class="text-sm text-gray-500 mt-1">Happy Patients</p>
            </div>
            <div class="py-8 px-6 text-center">
                <p class="text-3xl font-bold text-gray-900">25+</p>
                <p class="text-sm text-gray-500 mt-1">Dental Specialists</p>
            </div>
            <div class="py-8 px-6 text-center">
                <p class="text-3xl font-bold text-gray-900">4.9</p>
                <p class="text-sm text-gray-500 mt-1">Patient Rating</p>
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
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900">Dental Services</h2>
            </div>
            <a href="{{ route('services.index') }}" class="text-primary-600 text-sm font-semibold hover:text-primary-700 mt-4 md:mt-0 inline-flex items-center gap-1.5">
                View all services <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
                <a href="{{ route('services.show', $service) }}" class="group bg-white rounded-xl p-7 border border-gray-100 hover:border-primary-200 hover:shadow-md transition-all duration-200">
                    <div class="w-12 h-12 bg-primary-50 rounded-lg flex items-center justify-center mb-5 group-hover:bg-primary-600 transition">
                        <i class="{{ $service->icon ?? 'fas fa-tooth' }} text-primary-600 text-lg group-hover:text-white transition"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $service->title }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ Str::limit($service->description, 130) }}</p>
                    <span class="inline-flex items-center gap-1 text-primary-600 text-sm font-medium mt-4 opacity-0 group-hover:opacity-100 transition">
                        Learn more <i class="fas fa-arrow-right text-xs"></i>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Why Choose Us --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <p class="text-primary-600 text-sm font-semibold uppercase tracking-wide mb-2">Why SmileCare</p>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mb-6">Dental Care You Can Trust</h2>
                <p class="text-gray-500 leading-relaxed mb-10">
                    We combine modern dentistry with a patient-first approach. Every treatment plan is tailored to your needs, delivered by specialists who genuinely care about your comfort.
                </p>
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-shield-halved text-primary-600 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Modern Equipment</h4>
                            <p class="text-sm text-gray-500">Digital X-rays, intraoral cameras, and laser dentistry for precise, comfortable treatments.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-user-doctor text-primary-600 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Experienced Specialists</h4>
                            <p class="text-sm text-gray-500">Board-certified dentists with advanced training across all dental disciplines.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-hand-holding-heart text-primary-600 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Gentle & Compassionate</h4>
                            <p class="text-sm text-gray-500">We take the time to explain every procedure and ensure you're comfortable throughout.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=800&q=80" alt="Dental treatment" class="rounded-2xl shadow-lg w-full">
                <div class="absolute -bottom-5 -left-5 bg-white rounded-xl shadow-lg p-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-award text-emerald-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Award Winning</p>
                        <p class="text-xs text-gray-500">Best Dental Clinic 2024</p>
                    </div>
                </div>
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
                <p class="text-primary-600 text-sm font-semibold uppercase tracking-wide mb-2">Meet the Team</p>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900">Our Dentists</h2>
            </div>
            <a href="{{ route('doctors.index') }}" class="text-primary-600 text-sm font-semibold hover:text-primary-700 mt-4 md:mt-0 inline-flex items-center gap-1.5">
                View all dentists <i class="fas fa-arrow-right text-xs"></i>
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
                        <p class="text-xs text-gray-400 mt-1">{{ $doctor->qualification }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Testimonials --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-primary-600 text-sm font-semibold uppercase tracking-wide mb-2">Patient Stories</p>
            <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900">What Our Patients Say</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-50 rounded-xl p-7">
                <div class="flex items-center gap-1 mb-4">
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed mb-6">
                    "I've been coming here for over three years. The staff is always professional and the treatments have been excellent. They made my root canal completely painless."
                </p>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-primary-100 rounded-full flex items-center justify-center">
                        <span class="text-primary-700 font-semibold text-sm">RK</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Rahim Khan</p>
                        <p class="text-xs text-gray-400">Regular Patient</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 rounded-xl p-7">
                <div class="flex items-center gap-1 mb-4">
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed mb-6">
                    "Brought my kids here and they actually enjoyed the visit. The pediatric dentist was incredibly patient and made them feel at ease. Highly recommend for families."
                </p>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-primary-100 rounded-full flex items-center justify-center">
                        <span class="text-primary-700 font-semibold text-sm">SA</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Sara Ahmed</p>
                        <p class="text-xs text-gray-400">Parent</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 rounded-xl p-7">
                <div class="flex items-center gap-1 mb-4">
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                    <i class="fas fa-star text-amber-400 text-xs"></i>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed mb-6">
                    "Got my teeth whitening done here and the results exceeded my expectations. The clinic is spotless, modern, and the pricing was very fair. Will definitely be back."
                </p>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-primary-100 rounded-full flex items-center justify-center">
                        <span class="text-primary-700 font-semibold text-sm">MH</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Michael Haque</p>
                        <p class="text-xs text-gray-400">New Patient</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="relative bg-primary-700 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <circle cx="80" cy="20" r="30" fill="white"/>
            <circle cx="20" cy="80" r="20" fill="white"/>
        </svg>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-white mb-2">Ready for a Brighter Smile?</h2>
                <p class="text-primary-100 text-sm max-w-lg">
                    Book your appointment today and take the first step towards healthier teeth and gums. New patients are always welcome.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 flex-shrink-0">
                <a href="{{ route('appointment.create') }}" class="bg-white text-primary-700 px-8 py-3.5 text-sm font-semibold rounded-lg hover:bg-gray-50 transition text-center">
                    Book Appointment
                </a>
                <a href="{{ route('contact.index') }}" class="border border-white/40 text-white px-8 py-3.5 text-sm font-semibold rounded-lg hover:bg-white/10 transition text-center">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
