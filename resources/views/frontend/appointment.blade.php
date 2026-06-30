@extends('layouts.frontend')

@section('title', 'Book Appointment - Azmeer Dental Care')

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

{{-- Appointment Info + Form --}}
<section class="py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Visiting Hours --}}
        <div class="bg-primary-50 rounded-2xl p-8 mb-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div>
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-user-doctor text-primary-600 text-lg"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Dr. Sher Shah, BDS</h3>
                    <p class="text-sm text-gray-500">Dental Surgeon · BMDC Reg. 10448</p>
                </div>
                <div>
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-clock text-primary-600 text-lg"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Visiting Hours</h3>
                    <p class="text-sm text-gray-500">Morning: 10:00 AM – 2:00 PM</p>
                    <p class="text-sm text-gray-500">Evening: 4:00 PM – 8:00 PM</p>
                </div>
                <div>
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-phone text-primary-600 text-lg"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Call for Appointment</h3>
                    <a href="tel:{{ $contactInfo->phone ?? '' }}" class="text-lg font-bold text-primary-600">{{ $contactInfo->phone ?? '01638209228' }}</a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Request an Appointment</h2>
                <p class="text-gray-600">Fill out the form below and we will get back to you to confirm your appointment.</p>
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
                                <option value="{{ $doctor->id }}" {{ old('doctor_id', $doctors->first()->id ?? '') == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->name }} — {{ $doctor->specialization }}
                                </option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Department --}}
                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-700 mb-2">Service Type</label>
                        <select name="department" id="department"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('department') border-red-500 @enderror">
                            <option value="">Select a service</option>
                            <option value="Dental Consultation" {{ old('department') == 'Dental Consultation' ? 'selected' : '' }}>Dental Consultation</option>
                            <option value="Oral Care" {{ old('department') == 'Oral Care' ? 'selected' : '' }}>Oral Care</option>
                            <option value="Dental Treatment" {{ old('department') == 'Dental Treatment' ? 'selected' : '' }}>Dental Treatment</option>
                            <option value="Dental Surgery" {{ old('department') == 'Dental Surgery' ? 'selected' : '' }}>Dental Surgery</option>
                        </select>
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
                        <select name="preferred_time" id="preferred_time"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('preferred_time') border-red-500 @enderror"
                            required>
                            <option value="">Select time</option>
                            <optgroup label="Morning (10:00 AM – 2:00 PM)">
                                <option value="10:00" {{ old('preferred_time') == '10:00' ? 'selected' : '' }}>10:00 AM</option>
                                <option value="10:30" {{ old('preferred_time') == '10:30' ? 'selected' : '' }}>10:30 AM</option>
                                <option value="11:00" {{ old('preferred_time') == '11:00' ? 'selected' : '' }}>11:00 AM</option>
                                <option value="11:30" {{ old('preferred_time') == '11:30' ? 'selected' : '' }}>11:30 AM</option>
                                <option value="12:00" {{ old('preferred_time') == '12:00' ? 'selected' : '' }}>12:00 PM</option>
                                <option value="12:30" {{ old('preferred_time') == '12:30' ? 'selected' : '' }}>12:30 PM</option>
                                <option value="13:00" {{ old('preferred_time') == '13:00' ? 'selected' : '' }}>1:00 PM</option>
                                <option value="13:30" {{ old('preferred_time') == '13:30' ? 'selected' : '' }}>1:30 PM</option>
                            </optgroup>
                            <optgroup label="Evening (4:00 PM – 8:00 PM)">
                                <option value="16:00" {{ old('preferred_time') == '16:00' ? 'selected' : '' }}>4:00 PM</option>
                                <option value="16:30" {{ old('preferred_time') == '16:30' ? 'selected' : '' }}>4:30 PM</option>
                                <option value="17:00" {{ old('preferred_time') == '17:00' ? 'selected' : '' }}>5:00 PM</option>
                                <option value="17:30" {{ old('preferred_time') == '17:30' ? 'selected' : '' }}>5:30 PM</option>
                                <option value="18:00" {{ old('preferred_time') == '18:00' ? 'selected' : '' }}>6:00 PM</option>
                                <option value="18:30" {{ old('preferred_time') == '18:30' ? 'selected' : '' }}>6:30 PM</option>
                                <option value="19:00" {{ old('preferred_time') == '19:00' ? 'selected' : '' }}>7:00 PM</option>
                                <option value="19:30" {{ old('preferred_time') == '19:30' ? 'selected' : '' }}>7:30 PM</option>
                            </optgroup>
                        </select>
                        @error('preferred_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Message --}}
                    <div class="md:col-span-2">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message / Symptoms</label>
                        <textarea name="message" id="message" rows="4"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('message') border-red-500 @enderror"
                            placeholder="Describe your dental concern or reason for visit...">{{ old('message') }}</textarea>
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
