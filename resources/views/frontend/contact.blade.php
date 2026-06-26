@extends('layouts.frontend')

@section('title', 'Contact Us - Hospital Management')

@section('content')
{{-- Page Header --}}
<section class="bg-primary-700 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Contact Us</h1>
        <nav class="flex justify-center gap-2 text-primary-200">
            <a href="{{ route('home') }}" class="hover:text-white">Home</a>
            <span>/</span>
            <span class="text-white">Contact</span>
        </nav>
    </div>
</section>

{{-- Contact Section --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            {{-- Contact Info --}}
            <div class="space-y-6">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Get In Touch</h3>
                    <p class="text-gray-600">We are here to help you. Reach out to us through any of the following channels.</p>
                </div>

                @if($contactInfo->address ?? null)
                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-primary-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Address</h4>
                            <p class="text-gray-600 text-sm">{{ $contactInfo->address }}</p>
                        </div>
                    </div>
                @endif

                @if($contactInfo->phone ?? null)
                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-primary-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Phone</h4>
                            <p class="text-gray-600 text-sm">{{ $contactInfo->phone }}</p>
                        </div>
                    </div>
                @endif

                @if($contactInfo->email ?? null)
                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-primary-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Email</h4>
                            <p class="text-gray-600 text-sm">{{ $contactInfo->email }}</p>
                        </div>
                    </div>
                @endif

                @if($contactInfo->whatsapp ?? null)
                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fab fa-whatsapp text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">WhatsApp</h4>
                            <p class="text-gray-600 text-sm">{{ $contactInfo->whatsapp }}</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Contact Form --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm p-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Send Us a Message</h3>
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Your Name *</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('name') border-red-500 @enderror"
                                    required>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('email') border-red-500 @enderror"
                                    required>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                                <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('subject') border-red-500 @enderror"
                                    required>
                                @error('subject')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                                <textarea name="message" id="message" rows="5"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('message') border-red-500 @enderror"
                                    required>{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="bg-primary-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-700 transition">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Google Map --}}
        @if($contactInfo->google_map_embed ?? null)
            <div class="mt-12 rounded-2xl overflow-hidden shadow-sm">
                {!! $contactInfo->google_map_embed !!}
            </div>
        @endif
    </div>
</section>
@endsection
