@extends('layouts.frontend')

@section('title', 'About Us - Azmeer Dental Care')

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
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">About the Clinic</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-6">Azmeer Dental Care</h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Azmeer Dental Care is a professional dental clinic located at Patgram Road, Jamalpur. We are committed to providing quality dental care services to our community with modern techniques and a patient-first approach.
                </p>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Our clinic offers a full range of dental services including consultations, oral care, dental treatments, and surgical procedures — all delivered by our experienced dental surgeon in a clean, comfortable environment.
                </p>
                <div class="flex items-center gap-4 p-5 bg-primary-50 rounded-xl">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-phone text-primary-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">For appointments</p>
                        <a href="tel:{{ $contactInfo->phone ?? '' }}" class="text-lg font-semibold text-gray-900">{{ $contactInfo->phone ?? '01638209228' }}</a>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=800&q=80" alt="Dental clinic" class="rounded-2xl shadow-xl w-full">
            </div>
        </div>
    </div>
</section>

{{-- Doctor Profile --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <div class="bg-white p-8 rounded-2xl shadow-sm">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user-doctor text-primary-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Dr. Sher Shah</h3>
                            <p class="text-primary-600 font-medium">Dental Surgeon</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-graduation-cap text-primary-600 text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Qualification</p>
                                <p class="text-sm text-gray-500">Bachelor of Dental Surgery (BDS)</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-id-card text-primary-600 text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">BMDC Registration</p>
                                <p class="text-sm text-gray-500">Reg. No: 10448</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-building-columns text-primary-600 text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Education</p>
                                <p class="text-sm text-gray-500">Sylhet MAG Osmani Medical College</p>
                                <p class="text-sm text-gray-500">Mymensingh Medical College</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-clock text-primary-600 text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Visiting Hours</p>
                                <p class="text-sm text-gray-500">Morning: 10:00 AM – 2:00 PM</p>
                                <p class="text-sm text-gray-500">Evening: 4:00 PM – 8:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">About the Doctor</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-6">Dr. Sher Shah, BDS</h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Dr. Sher Shah is a qualified Dental Surgeon registered with the Bangladesh Medical and Dental Council. He completed his Bachelor of Dental Surgery (BDS) from Sylhet MAG Osmani Medical College and Mymensingh Medical College.
                </p>
                <p class="text-gray-600 leading-relaxed mb-6">
                    With a deep commitment to oral health and patient care, Dr. Shah provides comprehensive dental services at Azmeer Dental Care. His approach combines modern dental techniques with a gentle, patient-focused experience — ensuring every visit is comfortable and effective.
                </p>
                <a href="{{ route('appointment.create') }}" class="bg-primary-600 text-white px-7 py-3 text-sm font-semibold rounded-lg hover:bg-primary-700 transition inline-flex items-center gap-2">
                    <i class="fas fa-calendar-check text-xs"></i>
                    Book Appointment
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Mission & Vision --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-50 p-8 rounded-2xl">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-bullseye text-primary-600 text-xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h3>
                <p class="text-gray-600 leading-relaxed">
                    To provide accessible, affordable, and quality dental care to the people of Jamalpur and surrounding areas. We are dedicated to improving oral health through professional treatment, patient education, and a welcoming clinic environment.
                </p>
            </div>
            <div class="bg-gray-50 p-8 rounded-2xl">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-eye text-primary-600 text-xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Vision</h3>
                <p class="text-gray-600 leading-relaxed">
                    To be the most trusted dental care provider in Jamalpur, recognized for clinical excellence, honest patient care, and a commitment to building healthier smiles across our community.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
