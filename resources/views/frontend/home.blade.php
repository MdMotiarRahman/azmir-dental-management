@extends('layouts.frontend')

@section('title', 'Home - Hospital Management')

@section('content')
{{-- Hero Section --}}
<section class="relative h-[600px] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=1600');">
    <div class="absolute inset-0 hero-bg"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
        <div class="text-white max-w-2xl">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                Your Health Is Our <span class="text-primary-300">Top Priority</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-8 leading-relaxed">
                We provide world-class healthcare services with experienced doctors, modern facilities, and compassionate care for every patient.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('appointment.create') }}" class="bg-white text-primary-700 px-8 py-3.5 rounded-lg font-semibold hover:bg-gray-100 transition text-center">
                    Book Appointment
                </a>
                <a href="{{ route('services.index') }}" class="border-2 border-white text-white px-8 py-3.5 rounded-lg font-semibold hover:bg-white hover:text-primary-700 transition text-center">
                    Our Services
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Features Section --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex items-start gap-4 p-6 rounded-xl hover:shadow-lg transition">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-user-md text-primary-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Expert Doctors</h3>
                    <p class="text-gray-600">Our team of experienced and qualified doctors provide the best medical care.</p>
                </div>
            </div>
            <div class="flex items-start gap-4 p-6 rounded-xl hover:shadow-lg transition">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-clock text-primary-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">24/7 Emergency</h3>
                    <p class="text-gray-600">Round-the-clock emergency services with rapid response team ready.</p>
                </div>
            </div>
            <div class="flex items-start gap-4 p-6 rounded-xl hover:shadow-lg transition">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-hospital text-primary-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Modern Equipment</h3>
                    <p class="text-gray-600">State-of-the-art medical equipment and technology for accurate diagnosis.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Services Section --}}
@if($services->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Our Services</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Quality Healthcare Services</h2>
            <p class="text-gray-600 mt-3 max-w-2xl mx-auto">Comprehensive medical services designed to meet your healthcare needs.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-lg transition group">
                    <div class="w-16 h-16 bg-primary-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary-600 transition">
                        <i class="{{ $service->icon ?? 'fas fa-medkit' }} text-primary-600 text-2xl group-hover:text-white transition"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $service->title }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ Str::limit($service->description, 150) }}</p>
                    <a href="{{ route('services.show', $service) }}" class="inline-flex items-center gap-2 mt-4 text-primary-600 hover:text-primary-700 font-medium">
                        Learn More <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('services.index') }}" class="bg-primary-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-700 transition inline-block">
                View All Services
            </a>
        </div>
    </div>
</section>
@endif

{{-- Doctors Section --}}
@if($doctors->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Our Doctors</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Meet Our Specialists</h2>
            <p class="text-gray-600 mt-3 max-w-2xl mx-auto">Experienced medical professionals dedicated to your health.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($doctors as $doctor)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition group">
                    <div class="h-64 bg-gray-200 overflow-hidden">
                        @if($doctor->photo)
                            <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-primary-50">
                                <i class="fas fa-user-md text-primary-300 text-6xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $doctor->name }}</h3>
                        <p class="text-primary-600 font-medium">{{ $doctor->specialization }}</p>
                        <p class="text-gray-500 text-sm mt-1">{{ $doctor->qualification }}</p>
                        <a href="{{ route('doctors.show', $doctor) }}" class="inline-flex items-center gap-2 mt-4 text-primary-600 hover:text-primary-700 font-medium">
                            View Profile <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('doctors.index') }}" class="bg-primary-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-700 transition inline-block">
                View All Doctors
            </a>
        </div>
    </div>
</section>
@endif

{{-- CTA Section --}}
<section class="py-16 bg-primary-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Need to Schedule an Appointment?</h2>
        <p class="text-primary-200 text-lg mb-8 max-w-2xl mx-auto">
            Book your appointment today and receive the best medical care from our experienced team of doctors.
        </p>
        <a href="{{ route('appointment.create') }}" class="bg-white text-primary-700 px-10 py-4 rounded-lg font-bold hover:bg-gray-100 transition inline-block text-lg">
            Book Appointment Now
        </a>
    </div>
</section>
@endsection
