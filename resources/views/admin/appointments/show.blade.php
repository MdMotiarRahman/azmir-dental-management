@extends('layouts.admin')

@section('title', 'Appointment Details')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.appointments.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium inline-flex items-center gap-1 mb-2">
        <i class="fas fa-arrow-left"></i> Back to Appointments
    </a>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Appointment Details</h1>
        <span class="px-4 py-2 rounded-full text-sm font-medium {{ $appointment->status_badge }}">
            {{ ucfirst($appointment->status) }}
        </span>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Patient Information --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Patient Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Full Name</label>
                    <p class="text-gray-900 font-medium">{{ $appointment->patient_name }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Phone</label>
                    <p class="text-gray-900">
                        <a href="tel:{{ $appointment->phone }}" class="text-primary-600 hover:text-primary-700">{{ $appointment->phone }}</a>
                    </p>
                </div>
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Email</label>
                    <p class="text-gray-900">
                        @if($appointment->email)
                            <a href="mailto:{{ $appointment->email }}" class="text-primary-600 hover:text-primary-700">{{ $appointment->email }}</a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </p>
                </div>
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Service</label>
                    <p class="text-gray-900">{{ $appointment->department ?: '-' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Appointment Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Preferred Date</label>
                    <p class="text-gray-900 font-medium">{{ $appointment->preferred_date->format('l, M d, Y') }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Preferred Time</label>
                    <p class="text-gray-900 font-medium">{{ $appointment->preferred_time }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Doctor</label>
                    <p class="text-gray-900">{{ $appointment->doctor->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Created</label>
                    <p class="text-gray-900">{{ $appointment->created_at->format('M d, Y h:i A') }}</p>
                </div>
            </div>
            @if($appointment->message)
                <div class="mt-4">
                    <label class="block text-sm text-gray-500 mb-1">Message</label>
                    <p class="text-gray-700 bg-gray-50 rounded-lg p-4">{{ $appointment->message }}</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-6">
        {{-- Status Update --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Update Status</h2>
            <form action="{{ route('admin.appointments.update-status', $appointment) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="space-y-3">
                    <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition {{ $appointment->status === 'pending' ? 'border-yellow-300 bg-yellow-50' : 'border-gray-200' }}">
                        <input type="radio" name="status" value="pending" {{ $appointment->status === 'pending' ? 'checked' : '' }} class="text-yellow-600 focus:ring-yellow-500">
                        <span class="text-sm font-medium text-gray-700">Pending</span>
                    </label>
                    <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition {{ $appointment->status === 'confirmed' ? 'border-blue-300 bg-blue-50' : 'border-gray-200' }}">
                        <input type="radio" name="status" value="confirmed" {{ $appointment->status === 'confirmed' ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                        <span class="text-sm font-medium text-gray-700">Confirmed</span>
                    </label>
                    <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition {{ $appointment->status === 'completed' ? 'border-green-300 bg-green-50' : 'border-gray-200' }}">
                        <input type="radio" name="status" value="completed" {{ $appointment->status === 'completed' ? 'checked' : '' }} class="text-green-600 focus:ring-green-500">
                        <span class="text-sm font-medium text-gray-700">Completed</span>
                    </label>
                    <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition {{ $appointment->status === 'cancelled' ? 'border-red-300 bg-red-50' : 'border-gray-200' }}">
                        <input type="radio" name="status" value="cancelled" {{ $appointment->status === 'cancelled' ? 'checked' : '' }} class="text-red-600 focus:ring-red-500">
                        <span class="text-sm font-medium text-gray-700">Cancelled</span>
                    </label>
                </div>
                <button type="submit" class="w-full mt-4 bg-primary-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-primary-700 transition">
                    Update Status
                </button>
            </form>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
            <div class="space-y-3">
                <a href="tel:{{ $appointment->phone }}" class="w-full flex items-center justify-center gap-2 bg-green-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-green-700 transition">
                    <i class="fas fa-phone"></i> Call Patient
                </a>
                @if($appointment->email)
                    <a href="mailto:{{ $appointment->email }}" class="w-full flex items-center justify-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition">
                        <i class="fas fa-envelope"></i> Send Email
                    </a>
                @endif
                <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-100 text-red-700 px-4 py-2.5 rounded-lg font-medium hover:bg-red-200 transition">
                        <i class="fas fa-trash"></i> Delete Appointment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
