<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SmileCare Dental Clinic')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        display: ['Playfair Display', 'Georgia', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
    </style>
</head>
<body class="bg-white font-sans antialiased text-gray-800">

    {{-- Top Bar --}}
    <div class="bg-gray-900 text-gray-300 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-center py-2.5 gap-2">
                <div class="flex items-center gap-5">
                    @if($contactInfo->phone ?? null)
                        <a href="tel:{{ $contactInfo->phone }}" class="flex items-center gap-1.5 hover:text-white transition">
                            <i class="fas fa-phone text-[10px]"></i>
                            {{ $contactInfo->phone }}
                        </a>
                    @endif
                    @if($contactInfo->email ?? null)
                        <a href="mailto:{{ $contactInfo->email }}" class="flex items-center gap-1.5 hover:text-white transition">
                            <i class="fas fa-envelope text-[10px]"></i>
                            {{ $contactInfo->email }}
                        </a>
                    @endif
                </div>
                <div class="flex items-center gap-4">
                    <span class="hidden sm:flex items-center gap-1.5">
                        <i class="fas fa-clock text-[10px]"></i>
                        Mon – Sat: 9:00 AM – 8:00 PM
                    </span>
                    @if($contactInfo->whatsapp ?? null)
                        <a href="https://wa.me/{{ $contactInfo->whatsapp }}" target="_blank" class="hover:text-white transition">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    @endif
                    @if($contactInfo->facebook ?? null)
                        <a href="{{ $contactInfo->facebook }}" target="_blank" class="hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-[72px]">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <div class="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-tooth text-white text-lg"></i>
                    </div>
                    <div class="leading-tight">
                        <span class="text-lg font-bold text-gray-900 tracking-tight">SmileCare</span>
                        <span class="block text-[11px] text-gray-400 font-medium tracking-wide uppercase">Dental Clinic</span>
                    </div>
                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-primary-600 rounded-lg transition {{ request()->routeIs('home') ? 'text-primary-600' : '' }}">Home</a>
                    <a href="{{ route('about') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-primary-600 rounded-lg transition {{ request()->routeIs('about') ? 'text-primary-600' : '' }}">About</a>
                    <a href="{{ route('services.index') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-primary-600 rounded-lg transition {{ request()->routeIs('services.*') ? 'text-primary-600' : '' }}">Services</a>
                    <a href="{{ route('doctors.index') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-primary-600 rounded-lg transition {{ request()->routeIs('doctors.*') ? 'text-primary-600' : '' }}">Doctors</a>
                    <a href="{{ route('contact.index') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-primary-600 rounded-lg transition {{ request()->routeIs('contact.*') ? 'text-primary-600' : '' }}">Contact</a>
                    <div class="w-px h-5 bg-gray-200 mx-2"></div>
                    <a href="{{ route('appointment.create') }}" class="bg-primary-600 text-white px-5 py-2.5 text-sm font-semibold rounded-lg hover:bg-primary-700 transition inline-flex items-center gap-2">
                        <i class="fas fa-calendar-check text-xs"></i>
                        Book Appointment
                    </a>
                </div>

                {{-- Mobile Menu Button --}}
                <button id="mobile-menu-btn" class="md:hidden w-10 h-10 flex items-center justify-center text-gray-600 hover:text-gray-900">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>

        {{-- Mobile Navigation --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white">
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('home') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-lg">Home</a>
                <a href="{{ route('about') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-lg">About</a>
                <a href="{{ route('services.index') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-lg">Services</a>
                <a href="{{ route('doctors.index') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-lg">Doctors</a>
                <a href="{{ route('contact.index') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-lg">Contact</a>
                <div class="pt-2">
                    <a href="{{ route('appointment.create') }}" class="block bg-primary-600 text-white px-5 py-2.5 text-sm font-semibold rounded-lg text-center">Book Appointment</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg flex items-center gap-3 text-sm">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center gap-3 text-sm">
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
    <footer class="bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                {{-- Brand --}}
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-5">
                        <div class="w-9 h-9 bg-primary-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-tooth text-white text-sm"></i>
                        </div>
                        <div class="leading-tight">
                            <span class="text-base font-bold text-white">SmileCare</span>
                            <span class="block text-[10px] text-gray-400 font-medium uppercase tracking-wider">Dental Clinic</span>
                        </div>
                    </a>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Your trusted dental care partner. We deliver healthy, beautiful smiles with modern techniques and a gentle touch.
                    </p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-white font-semibold text-sm mb-4">Quick Links</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition">About Us</a></li>
                        <li><a href="{{ route('services.index') }}" class="text-gray-400 hover:text-white transition">Services</a></li>
                        <li><a href="{{ route('doctors.index') }}" class="text-gray-400 hover:text-white transition">Our Dentists</a></li>
                        <li><a href="{{ route('contact.index') }}" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>

                {{-- Services --}}
                <div>
                    <h4 class="text-white font-semibold text-sm mb-4">Our Services</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('services.index') }}" class="text-gray-400 hover:text-white transition">General Dentistry</a></li>
                        <li><a href="{{ route('services.index') }}" class="text-gray-400 hover:text-white transition">Teeth Whitening</a></li>
                        <li><a href="{{ route('services.index') }}" class="text-gray-400 hover:text-white transition">Orthodontics</a></li>
                        <li><a href="{{ route('services.index') }}" class="text-gray-400 hover:text-white transition">Dental Implants</a></li>
                        <li><a href="{{ route('services.index') }}" class="text-gray-400 hover:text-white transition">Root Canal</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="text-white font-semibold text-sm mb-4">Get in Touch</h4>
                    <ul class="space-y-3 text-sm">
                        @if($contactInfo->address ?? null)
                            <li class="flex items-start gap-2.5 text-gray-400">
                                <i class="fas fa-map-marker-alt mt-0.5 text-xs"></i>
                                <span>{{ $contactInfo->address }}</span>
                            </li>
                        @endif
                        @if($contactInfo->phone ?? null)
                            <li class="flex items-center gap-2.5 text-gray-400">
                                <i class="fas fa-phone text-xs"></i>
                                <a href="tel:{{ $contactInfo->phone }}" class="hover:text-white transition">{{ $contactInfo->phone }}</a>
                            </li>
                        @endif
                        @if($contactInfo->email ?? null)
                            <li class="flex items-center gap-2.5 text-gray-400">
                                <i class="fas fa-envelope text-xs"></i>
                                <a href="mailto:{{ $contactInfo->email }}" class="hover:text-white transition">{{ $contactInfo->email }}</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
                    <p class="text-xs text-gray-500">&copy; {{ date('Y') }} SmileCare Dental Clinic. All rights reserved.</p>
                    <div class="flex items-center gap-3">
                        @if($contactInfo->facebook ?? null)
                            <a href="{{ $contactInfo->facebook }}" target="_blank" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition">
                                <i class="fab fa-facebook-f text-xs"></i>
                            </a>
                        @endif
                        @if($contactInfo->whatsapp ?? null)
                            <a href="https://wa.me/{{ $contactInfo->whatsapp }}" target="_blank" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-green-600 hover:text-white transition">
                                <i class="fab fa-whatsapp text-xs"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>
