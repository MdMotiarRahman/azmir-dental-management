@extends('layouts.frontend')

@section('title', $doctor->name . ' - Azmeer Dental Care')

@section('content')
{{-- Page Header --}}
<section class="bg-primary-700 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $doctor->name }}</h1>
        <nav class="flex justify-center gap-2 text-primary-200">
            <a href="{{ route('home') }}" class="hover:text-white">Home</a>
            <span>/</span>
            <a href="{{ route('doctors.index') }}" class="hover:text-white">Doctor</a>
            <span>/</span>
            <span class="text-white">{{ $doctor->name }}</span>
        </nav>
    </div>
</section>

{{-- Doctor Detail --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            {{-- Profile Card --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden sticky top-24">
                    <div class="h-72 bg-gray-200 overflow-hidden">
                        @if($doctor->photo)
                            <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-primary-50">
                                <i class="fas fa-user-md text-primary-300 text-7xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 text-center">
                        <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $doctor->name }}</h2>
                        <p class="text-primary-600 font-semibold mb-4">{{ $doctor->specialization }}</p>
                        <a href="{{ route('appointment.create') }}" class="block w-full bg-primary-600 text-white text-center px-6 py-3 rounded-lg font-semibold hover:bg-primary-700 transition">
                            Book Appointment
                        </a>
                    </div>
                </div>
            </div>

            {{-- Details --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm p-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">About Doctor</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-graduation-cap text-primary-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Qualification</p>
                                <p class="font-medium text-gray-900">{{ $doctor->qualification }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-stethoscope text-primary-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Specialization</p>
                                <p class="font-medium text-gray-900">{{ $doctor->specialization }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-id-card text-primary-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Registration No.</p>
                                <p class="font-medium text-gray-900">{{ $doctor->registration_number }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-clock text-primary-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Visiting Hours</p>
                                <p class="font-medium text-gray-900">{{ $doctor->visiting_hours }}</p>
                            </div>
                        </div>
                    </div>

                    @if($doctor->bio)
                        <div class="border-t pt-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">Biography</h4>
                            <p class="text-gray-600 leading-relaxed">{{ $doctor->bio }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
