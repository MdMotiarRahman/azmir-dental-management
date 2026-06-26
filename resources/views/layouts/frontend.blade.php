<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hospital Management')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#2563eb',
                            600: '#1d4ed8',
                            700: '#1e40af',
                            800: '#1e3a8a',
                            900: '#1e3a5f',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .hero-bg {
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.85) 0%, rgba(30, 58, 95, 0.9) 100%);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    {{-- Top Bar --}}
    <div class="bg-primary-900 text-white text-sm py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-2">
                <div class="flex items-center gap-6">
                    @if($contactInfo->phone ?? null)
                        <span class="flex items-center gap-1">
                            <i class="fas fa-phone"></i>
                            {{ $contactInfo->phone }}
                        </span>
                    @endif
                    @if($contactInfo->email ?? null)
                        <span class="flex items-center gap-1">
                            <i class="fas fa-envelope"></i>
                            {{ $contactInfo->email }}
                        </span>
                    @endif
                </div>
                <div class="flex items-center gap-4">
                    @if($contactInfo->whatsapp ?? null)
                        <a href="https://wa.me/{{ $contactInfo->whatsapp }}" target="_blank" class="hover:text-primary-300">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    @endif
                    @if($contactInfo->facebook ?? null)
                        <a href="{{ $contactInfo->facebook }}" target="_blank" class="hover:text-primary-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-heartbeat text-white text-xl"></i>
                    </div>
                    <div>
                        <span class="text-xl font-bold text-primary-900">Hospital</span>
                        <span class="block text-xs text-gray-500">Management System</span>
                    </div>
                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600 font-medium transition">Home</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-primary-600 font-medium transition">About</a>
                    <a href="{{ route('services.index') }}" class="text-gray-700 hover:text-primary-600 font-medium transition">Services</a>
                    <a href="{{ route('doctors.index') }}" class="text-gray-700 hover:text-primary-600 font-medium transition">Doctors</a>
                    <a href="{{ route('contact.index') }}" class="text-gray-700 hover:text-primary-600 font-medium transition">Contact</a>
                    <a href="{{ route('appointment.create') }}" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg hover:bg-primary-700 font-medium transition">
                        Book Appointment
                    </a>
                </div>

                {{-- Mobile Menu Button --}}
                <button id="mobile-menu-btn" class="md:hidden text-gray-700">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>

        {{-- Mobile Navigation --}}
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-primary-600 font-medium">Home</a>
                <a href="{{ route('about') }}" class="block py-2 text-gray-700 hover:text-primary-600 font-medium">About</a>
                <a href="{{ route('services.index') }}" class="block py-2 text-gray-700 hover:text-primary-600 font-medium">Services</a>
                <a href="{{ route('doctors.index') }}" class="block py-2 text-gray-700 hover:text-primary-600 font-medium">Doctors</a>
                <a href="{{ route('contact.index') }}" class="block py-2 text-gray-700 hover:text-primary-600 font-medium">Contact</a>
                <a href="{{ route('appointment.create') }}" class="block bg-primary-600 text-white px-6 py-2.5 rounded-lg text-center font-medium">Book Appointment</a>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-3">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center gap-3">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                {{-- About --}}
                <div class="md:col-span-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-primary-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-heartbeat text-white"></i>
                        </div>
                        <span class="text-lg font-bold text-white">Hospital</span>
                    </div>
                    <p class="text-sm leading-relaxed">
                        Providing quality healthcare services with compassion and excellence. Your health is our priority.
                    </p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h3 class="text-white font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">About Us</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-white transition">Services</a></li>
                        <li><a href="{{ route('doctors.index') }}" class="hover:text-white transition">Doctors</a></li>
                    </ul>
                </div>

                {{-- Services --}}
                <div>
                    <h3 class="text-white font-semibold mb-4">Services</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('services.index') }}" class="hover:text-white transition">Emergency Care</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-white transition">Cardiology</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-white transition">Neurology</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-white transition">Orthopedics</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h3 class="text-white font-semibold mb-4">Contact Info</h3>
                    <ul class="space-y-3 text-sm">
                        @if($contactInfo->address ?? null)
                            <li class="flex items-start gap-2">
                                <i class="fas fa-map-marker-alt mt-1"></i>
                                <span>{{ $contactInfo->address }}</span>
                            </li>
                        @endif
                        @if($contactInfo->phone ?? null)
                            <li class="flex items-center gap-2">
                                <i class="fas fa-phone"></i>
                                <span>{{ $contactInfo->phone }}</span>
                            </li>
                        @endif
                        @if($contactInfo->email ?? null)
                            <li class="flex items-center gap-2">
                                <i class="fas fa-envelope"></i>
                                <span>{{ $contactInfo->email }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        {{-- Bottom Footer --}}
        <div class="border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm">&copy; {{ date('Y') }} Hospital Management System. All rights reserved.</p>
                    <div class="flex items-center gap-4">
                        @if($contactInfo->facebook ?? null)
                            <a href="{{ $contactInfo->facebook }}" target="_blank" class="hover:text-white transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if($contactInfo->whatsapp ?? null)
                            <a href="https://wa.me/{{ $contactInfo->whatsapp }}" target="_blank" class="hover:text-white transition">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>
