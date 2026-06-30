@extends('layouts.frontend')

@section('title', $service->title . ' - Azmeer Dental Care')

@section('content')
{{-- Page Header --}}
<section class="bg-primary-700 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $service->title }}</h1>
        <nav class="flex justify-center gap-2 text-primary-200">
            <a href="{{ route('home') }}" class="hover:text-white">Home</a>
            <span>/</span>
            <a href="{{ route('services.index') }}" class="hover:text-white">Services</a>
            <span>/</span>
            <span class="text-white">{{ $service->title }}</span>
        </nav>
    </div>
</section>

{{-- Service Detail --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            {{-- Main Content --}}
            <div class="lg:col-span-2">
                @if($service->image)
                    <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-full h-80 object-cover rounded-2xl mb-8">
                @endif
                <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ $service->title }}</h2>
                <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                    {!! nl2br(e($service->description)) !!}
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-2xl p-8 sticky top-24">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Need Help?</h3>
                    @if($contactInfo->phone ?? null)
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-phone text-primary-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Call Us</p>
                                <p class="font-medium text-gray-900">{{ $contactInfo->phone }}</p>
                            </div>
                        </div>
                    @endif
                    @if($contactInfo->email ?? null)
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-envelope text-primary-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium text-gray-900">{{ $contactInfo->email }}</p>
                            </div>
                        </div>
                    @endif
                    <a href="{{ route('appointment.create') }}" class="block w-full bg-primary-600 text-white text-center px-6 py-3 rounded-lg font-semibold hover:bg-primary-700 transition mt-6">
                        Book Appointment
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
