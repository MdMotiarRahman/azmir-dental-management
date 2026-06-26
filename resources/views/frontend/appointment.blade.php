@extends('layouts.frontend')

@section('title', 'Book Appointment - Hospital Management')

@section('content')
{{-- Page Header --}}
<section class="bg-primary-700 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Book Appointment</h1>
        <nav class="flex justify-center gap-2 text-primary-200">
            <a href="{{ route('home') }}" class="hover:text-white">Home</a>
            <span>/</span>
            <span class="text-white">Appointment</span>
        </nav>
    </div>
</section>

{{-- Appointment Form --}}
<section class="py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Schedule Your Visit</h2>
                <p class="text-gray-600">Fill out the form below to book an appointment with our doctors.</p>
            </div>

            <form action="{{ route('appointment.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Patient Name --}}
                    <div>
                        <label for="patient_name" class="block text-sm font-medium text-gray-700 mb-2">Patient Name *</label>
                        <input type="text" name="patient_name" id="patient_name" value="{{ old('patient_name') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('patient_name') border-red-500 @enderror"
                            required>
                        @error('patient_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('phone') border-red-500 @enderror"
                            required>
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Doctor --}}
                    <div>
                        <label for="doctor_id" class="block text-sm font-medium text-gray-700 mb-2">Select Doctor *</label>
                        <select name="doctor_id" id="doctor_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('doctor_id') border-red-500 @enderror"
                            required>
                            <option value="">Choose a doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->name }} - {{ $doctor->specialization }}
                                </option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Department --}}
                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                        <input type="text" name="department" id="department" value="{{ old('department') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('department') border-red-500 @enderror"
                            placeholder="e.g. Cardiology">
                        @error('department')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Preferred Date --}}
                    <div>
                        <label for="preferred_date" class="block text-sm font-medium text-gray-700 mb-2">Preferred Date *</label>
                        <input type="date" name="preferred_date" id="preferred_date" value="{{ old('preferred_date') }}"
                            min="{{ date('Y-m-d') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('preferred_date') border-red-500 @enderror"
                            required>
                        @error('preferred_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Preferred Time --}}
                    <div>
                        <label for="preferred_time" class="block text-sm font-medium text-gray-700 mb-2">Preferred Time *</label>
                        <input type="time" name="preferred_time" id="preferred_time" value="{{ old('preferred_time') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('preferred_time') border-red-500 @enderror"
                            required>
                        @error('preferred_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Message --}}
                    <div class="md:col-span-2">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message / Symptoms</label>
                        <textarea name="message" id="message" rows="4"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('message') border-red-500 @enderror"
                            placeholder="Describe your symptoms or reason for visit...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full bg-primary-600 text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-primary-700 transition">
                        Submit Appointment Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
