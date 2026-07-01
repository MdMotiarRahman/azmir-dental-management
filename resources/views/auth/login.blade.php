<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login — Azmeer Dental Care</title>
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
                            50: '#f0f9ff', 100: '#e0f2fe', 200: '#bae6fd', 300: '#7dd3fc',
                            400: '#38bdf8', 500: '#0ea5e9', 600: '#0284c7', 700: '#0369a1',
                            800: '#075985', 900: '#0c4a6e',
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
</head>
<body class="font-sans antialiased bg-gray-900">
    <div class="min-h-screen flex">
        {{-- Left Panel — Branding --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-primary-700 to-gray-900"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://images.unsplash.com/photo-1606811971618-4486d14f3f99?w=1200&q=80'); background-size: cover; background-position: center;"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>

            <div class="relative z-10 flex flex-col justify-between p-12 w-full">
                {{-- Logo --}}
                <a href="/" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <i class="fas fa-tooth text-white text-xl"></i>
                    </div>
                    <div class="flex flex-col leading-none gap-0.5">
                        <span class="text-xl font-extrabold text-white tracking-wide">AZMEER</span>
                        <span class="text-[10px] font-semibold text-primary-200 tracking-[0.32em]">Dental Care</span>
                    </div>
                </a>

                {{-- Center Content --}}
                <div class="max-w-md">
                    <h1 class="text-4xl font-display font-bold text-white leading-tight mb-4">
                        Admin <span class="text-primary-300">Dashboard</span>
                    </h1>
                    <p class="text-primary-100/80 text-lg leading-relaxed">
                        Manage appointments, doctors, services, and patient messages — all in one place.
                    </p>
                </div>

                {{-- Bottom Info --}}
                <div class="flex items-center gap-6 text-primary-200/60 text-sm">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-shield-halved"></i> Secure Login
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-clock"></i> 24/7 Access
                    </span>
                </div>
            </div>
        </div>

        {{-- Right Panel — Login Form --}}
        <div class="flex-1 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                {{-- Mobile Logo --}}
                <div class="lg:hidden flex items-center gap-3 mb-10">
                    <div class="w-11 h-11 bg-primary-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-tooth text-white text-lg"></i>
                    </div>
                    <div class="flex flex-col leading-none gap-0.5">
                        <span class="text-lg font-extrabold text-white tracking-wide">AZMEER</span>
                        <span class="text-[9px] font-semibold text-primary-400 tracking-[0.32em]">Dental Care</span>
                    </div>
                </div>

                {{-- Header --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-white mb-2">Welcome back</h2>
                    <p class="text-gray-400">Sign in to your admin account</p>
                </div>

                {{-- Errors --}}
                @if($errors->any())
                    <div class="mb-6 bg-red-500/10 border border-red-500/20 rounded-xl p-4 flex items-center gap-3">
                        <i class="fas fa-exclamation-circle text-red-400"></i>
                        <span class="text-red-300 text-sm">{{ $errors->first() }}</span>
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-500 text-sm"></i>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                                class="w-full bg-gray-800/50 border border-gray-700 text-white rounded-xl px-4 py-3.5 pl-11 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition placeholder-gray-500"
                                placeholder="admin@azmeerdental.com">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-500 text-sm"></i>
                            </div>
                            <input type="password" name="password" id="password" required
                                class="w-full bg-gray-800/50 border border-gray-700 text-white rounded-xl px-4 py-3.5 pl-11 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition placeholder-gray-500"
                                placeholder="Enter your password">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-gray-600 bg-gray-800 text-primary-500 focus:ring-primary-500 focus:ring-offset-0">
                            <span class="text-sm text-gray-400">Remember me</span>
                        </label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-primary-400 hover:text-primary-300 transition">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                        class="w-full bg-primary-600 text-white font-semibold rounded-xl px-6 py-3.5 hover:bg-primary-700 focus:ring-4 focus:ring-primary-500/30 transition flex items-center justify-center gap-2">
                        <i class="fas fa-sign-in-alt text-sm"></i>
                        Sign In
                    </button>
                </form>

                {{-- Footer --}}
                <div class="mt-8 text-center">
                    <a href="/" class="text-sm text-gray-500 hover:text-gray-300 transition inline-flex items-center gap-1.5">
                        <i class="fas fa-arrow-left text-xs"></i> Back to website
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
