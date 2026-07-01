@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-6 md:mb-8">
    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-gray-600 text-sm md:text-base">Welcome back, {{ auth()->user()->name }}!</p>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-5 gap-3 md:gap-6 mb-6 md:mb-8">
    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs md:text-sm text-gray-500">Doctors</p>
                <p class="text-2xl md:text-3xl font-bold text-gray-900">{{ $totalDoctors }}</p>
            </div>
            <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-user-md text-blue-600 md:text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs md:text-sm text-gray-500">Services</p>
                <p class="text-2xl md:text-3xl font-bold text-gray-900">{{ $totalServices }}</p>
            </div>
            <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-stethoscope text-green-600 md:text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs md:text-sm text-gray-500">Total Appts</p>
                <p class="text-2xl md:text-3xl font-bold text-gray-900">{{ $totalAppointments }}</p>
            </div>
            <div class="w-10 h-10 md:w-12 md:h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-calendar-check text-purple-600 md:text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs md:text-sm text-gray-500">Today</p>
                <p class="text-2xl md:text-3xl font-bold text-gray-900">{{ $todayAppointments }}</p>
            </div>
            <div class="w-10 h-10 md:w-12 md:h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-calendar-day text-yellow-600 md:text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6 col-span-2 lg:col-span-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs md:text-sm text-gray-500">Pending</p>
                <p class="text-2xl md:text-3xl font-bold text-gray-900">{{ $pendingAppointments }}</p>
            </div>
            <div class="w-10 h-10 md:w-12 md:h-12 bg-red-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-clock text-red-600 md:text-xl"></i>
            </div>
        </div>
    </div>
</div>

{{-- Recent Appointments --}}
<div class="bg-white rounded-xl shadow-sm">
    <div class="p-4 md:p-6 border-b">
        <div class="flex items-center justify-between">
            <h2 class="text-base md:text-lg font-semibold text-gray-900">Recent Appointments</h2>
            <a href="{{ route('admin.appointments.index') }}" class="text-primary-600 hover:text-primary-700 text-xs md:text-sm font-medium">View All</a>
        </div>
    </div>

    {{-- Desktop Table --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($recentAppointments as $appointment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $appointment->patient_name }}</div>
                            <div class="text-sm text-gray-500">{{ $appointment->phone }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $appointment->doctor->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $appointment->preferred_date->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $appointment->preferred_time }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $appointment->status_badge }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            No recent appointments found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Mobile Cards --}}
    <div class="md:hidden divide-y divide-gray-100">
        @forelse($recentAppointments as $appointment)
            <a href="{{ route('admin.appointments.show', $appointment) }}" class="block p-4 hover:bg-gray-50 transition">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $appointment->patient_name }}</p>
                        <p class="text-xs text-gray-500">{{ $appointment->phone }}</p>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[11px] font-medium {{ $appointment->status_badge }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </div>
                <div class="flex items-center gap-4 text-xs text-gray-500">
                    <span class="flex items-center gap-1">
                        <i class="fas fa-user-md"></i> {{ $appointment->doctor->name ?? 'N/A' }}
                    </span>
                    <span class="flex items-center gap-1">
                        <i class="fas fa-calendar"></i> {{ $appointment->preferred_date->format('M d') }}
                    </span>
                    <span class="flex items-center gap-1">
                        <i class="fas fa-clock"></i> {{ $appointment->preferred_time }}
                    </span>
                </div>
            </a>
        @empty
            <div class="p-8 text-center text-gray-500 text-sm">
                No recent appointments found.
            </div>
        @endforelse
    </div>
</div>
@endsection
