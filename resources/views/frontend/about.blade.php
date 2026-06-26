@extends('layouts.frontend')

@section('title', 'About Us - Hospital Management')

@section('content')
{{-- Page Header --}}
<section class="bg-primary-700 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">About Us</h1>
        <nav class="flex justify-center gap-2 text-primary-200">
            <a href="{{ route('home') }}" class="hover:text-white">Home</a>
            <span>/</span>
            <span class="text-white">About Us</span>
        </nav>
    </div>
</section>

{{-- About Content --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">About Our Hospital</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-6">We Are Dedicated to Your Health & Well-being</h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    With over 15 years of experience in healthcare, our hospital has been serving the community with compassion, integrity, and excellence. We are committed to providing personalized medical care to every patient who walks through our doors.
                </p>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Our team of highly qualified doctors, nurses, and support staff work together to ensure that you receive the best possible treatment in a comfortable and caring environment.
                </p>
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div class="text-center p-4 bg-primary-50 rounded-xl">
                        <span class="text-3xl font-bold text-primary-600">15+</span>
                        <p class="text-gray-600 mt-1">Years Experience</p>
                    </div>
                    <div class="text-center p-4 bg-primary-50 rounded-xl">
                        <span class="text-3xl font-bold text-primary-600">50+</span>
                        <p class="text-gray-600 mt-1">Expert Doctors</p>
                    </div>
                    <div class="text-center p-4 bg-primary-50 rounded-xl">
                        <span class="text-3xl font-bold text-primary-600">10k+</span>
                        <p class="text-gray-600 mt-1">Happy Patients</p>
                    </div>
                    <div class="text-center p-4 bg-primary-50 rounded-xl">
                        <span class="text-3xl font-bold text-primary-600">20+</span>
                        <p class="text-gray-600 mt-1">Departments</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=800" alt="About Hospital" class="rounded-2xl shadow-xl">
                <div class="absolute -bottom-6 -left-6 bg-primary-600 text-white p-6 rounded-xl shadow-lg">
                    <i class="fas fa-award text-3xl mb-2"></i>
                    <p class="font-semibold">Best Healthcare Award</p>
                    <p class="text-primary-200 text-sm">2024</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Mission & Vision --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-bullseye text-primary-600 text-xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h3>
                <p class="text-gray-600 leading-relaxed">
                    To provide accessible, affordable, and quality healthcare services to all members of our community. We strive to be a leader in medical innovation while maintaining the highest standards of patient care and safety.
                </p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-eye text-primary-600 text-xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Vision</h3>
                <p class="text-gray-600 leading-relaxed">
                    To be the most trusted healthcare institution in the region, recognized for clinical excellence, compassionate care, and commitment to improving the health and well-being of the communities we serve.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Our Team --}}
@if($doctors->count() > 0)
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Our Team</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Meet Our Specialists</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($doctors as $doctor)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden text-center group hover:shadow-lg transition">
                    <div class="h-56 bg-gray-200 overflow-hidden">
                        @if($doctor->photo)
                            <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-primary-50">
                                <i class="fas fa-user-md text-primary-300 text-5xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $doctor->name }}</h3>
                        <p class="text-primary-600 text-sm">{{ $doctor->specialization }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
