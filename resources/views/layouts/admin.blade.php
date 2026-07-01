<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Azmeer Dental Care</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd',
                            400: '#60a5fa', 500: '#2563eb', 600: '#1d4ed8', 700: '#1e40af',
                            800: '#1e3a8a', 900: '#1e3a5f',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-link.active {
            background-color: rgb(29 78 216 / 0.1);
            color: rgb(37 99 235);
        }
        @media (min-width: 768px) {
            .sidebar-link.active {
                border-right: 3px solid rgb(37 99 235);
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">

        {{-- Mobile Sidebar Backdrop --}}
        <div id="sidebar-backdrop" class="fixed inset-0 z-40 bg-black/50 hidden md:hidden" onclick="toggleSidebar()"></div>

        {{-- Sidebar --}}
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg flex flex-col transition-transform duration-300 -translate-x-full md:translate-x-0 md:relative md:z-auto">
            {{-- Logo --}}
            <div class="h-16 flex items-center justify-between border-b px-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 bg-primary-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-tooth text-white text-sm"></i>
                    </div>
                    <div class="leading-tight">
                        <span class="text-sm font-bold text-gray-900">Azmeer Dental</span>
                        <span class="block text-[10px] text-gray-400 font-medium">Admin Panel</span>
                    </div>
                </a>
                <button onclick="toggleSidebar()" class="md:hidden text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 py-4 overflow-y-auto">
                <ul class="space-y-1 px-3">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt w-5 text-center"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.doctors.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm {{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
                            <i class="fas fa-user-md w-5 text-center"></i>
                            <span>Doctors</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.patients.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm {{ request()->routeIs('admin.patients.*') ? 'active' : '' }}">
                            <i class="fas fa-user-injured w-5 text-center"></i>
                            <span>Patients</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.services.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                            <i class="fas fa-stethoscope w-5 text-center"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.appointments.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check w-5 text-center"></i>
                            <span>Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contact.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                            <i class="fas fa-phone-alt w-5 text-center"></i>
                            <span>Contact Info</span>
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- Sidebar Footer --}}
            <div class="border-t p-3 space-y-1">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-2 text-gray-600 hover:text-primary-600 transition text-sm rounded-lg hover:bg-gray-50">
                    <i class="fas fa-external-link-alt w-5 text-center"></i>
                    <span>View Website</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-4 py-2 text-gray-600 hover:text-red-600 transition text-sm rounded-lg hover:bg-gray-50 w-full">
                        <i class="fas fa-sign-out-alt w-5 text-center"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden min-w-0">
            {{-- Top Header --}}
            <header class="h-14 md:h-16 bg-white shadow-sm flex items-center justify-between px-4 md:px-6 flex-shrink-0">
                <button onclick="toggleSidebar()" class="md:hidden text-gray-600 p-1.5 -ml-1.5 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-bars text-lg"></i>
                </button>
                <div class="flex items-center gap-3 ml-auto">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    <div class="w-9 h-9 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user text-primary-600 text-sm"></i>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        function swalConfirm(form, title, text) {
            title = title || 'Are you sure?';
            text = text || 'This action cannot be undone.';
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1d4ed8',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, proceed',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        function swalSuccess(title, text) {
            Swal.fire({
                icon: 'success',
                title: title || 'Success',
                text: text || '',
                confirmButtonColor: '#1d4ed8',
                timer: 3000,
                timerProgressBar: true,
            });
        }

        function swalError(title, text) {
            Swal.fire({
                icon: 'error',
                title: title || 'Error',
                text: text || 'Something went wrong.',
                confirmButtonColor: '#1d4ed8',
            });
        }
    </script>
    @if(session('success'))
        <script>swalSuccess('Success', '{{ session('success') }}');</script>
    @endif
    @if(session('error'))
        <script>swalError('Error', '{{ session('error') }}');</script>
    @endif
    @stack('scripts')
</body>
</html>
