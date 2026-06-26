@extends('layouts.frontend')

@section('title', 'Our Doctors - Hospital Management')

@section('content')
{{-- Page Header --}}
<section class="bg-primary-700 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Our Doctors</h1>
        <nav class="flex justify-center gap-2 text-primary-200">
            <a href="{{ route('home') }}" class="hover:text-white">Home</a>
            <span>/</span>
            <span class="text-white">Doctors</span>
        </nav>
    </div>
</section>

{{-- Doctors Grid --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($doctors->count() > 0)
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
                            <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ $doctor->name }}</h3>
                            <p class="text-primary-600 font-medium mb-1">{{ $doctor->specialization }}</p>
                            <p class="text-gray-500 text-sm mb-3">{{ $doctor->qualification }}</p>
                            <p class="text-gray-400 text-sm mb-4">
                                <i class="fas fa-clock mr-1"></i> {{ $doctor->visiting_hours }}
                            </p>
                            <a href="{{ route('doctors.show', $doctor) }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-medium">
                                View Profile <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $doctors->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-user-md text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">No doctors available at the moment.</p>
            </div>
        @endif
    </div>
</section>
@endsection
