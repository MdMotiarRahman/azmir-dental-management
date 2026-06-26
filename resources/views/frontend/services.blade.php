@extends('layouts.frontend')

@section('title', 'Our Services - Hospital Management')

@section('content')
{{-- Page Header --}}
<section class="bg-primary-700 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Our Services</h1>
        <nav class="flex justify-center gap-2 text-primary-200">
            <a href="{{ route('home') }}" class="hover:text-white">Home</a>
            <span>/</span>
            <span class="text-white">Services</span>
        </nav>
    </div>
</section>

{{-- Services Grid --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition group">
                        @if($service->image)
                            <div class="h-48 overflow-hidden">
                                <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            </div>
                        @endif
                        <div class="p-8">
                            <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary-600 transition">
                                <i class="{{ $service->icon ?? 'fas fa-medkit' }} text-primary-600 text-xl group-hover:text-white transition"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $service->title }}</h3>
                            <p class="text-gray-600 leading-relaxed mb-4">{{ Str::limit($service->description, 200) }}</p>
                            <a href="{{ route('services.show', $service) }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-medium">
                                Learn More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-stethoscope text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">No services available at the moment.</p>
            </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-primary-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Need Medical Assistance?</h2>
        <p class="text-primary-200 mb-8 max-w-xl mx-auto">Contact us or book an appointment to consult with our specialists.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('appointment.create') }}" class="bg-white text-primary-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Book Appointment</a>
            <a href="{{ route('contact.index') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary-700 transition">Contact Us</a>
        </div>
    </div>
</section>
@endsection
