@extends('layouts.frontend')

@section('title', 'Our Services - Azmeer Dental Care')

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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                @foreach($services as $service)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition group">
                        <div class="p-8">
                            <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary-600 transition">
                                <i class="{{ $service->icon ?? 'fas fa-tooth' }} text-primary-600 text-xl group-hover:text-white transition"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $service->title }}</h3>
                            <p class="text-gray-600 leading-relaxed mb-4">{{ $service->description }}</p>
                            <a href="{{ route('services.show', $service) }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-medium text-sm">
                                Learn More <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-tooth text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Services information will be available soon.</p>
            </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-primary-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Need Dental Care?</h2>
        <p class="text-primary-200 mb-8 max-w-xl mx-auto">Book an appointment with Dr. Sher Shah for a consultation or treatment.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="tel:{{ $contactInfo->phone ?? '' }}" class="bg-white text-primary-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-flex items-center justify-center gap-2">
                <i class="fas fa-phone text-sm"></i>
                Call: {{ $contactInfo->phone ?? '01638209228' }}
            </a>
            <a href="{{ route('contact.index') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary-700 transition">Get Directions</a>
        </div>
    </div>
</section>
@endsection
