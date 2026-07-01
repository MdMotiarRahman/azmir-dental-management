@extends('layouts.admin')

@section('title', 'Appointment Details')

@section('content')
<div class="mb-6 md:mb-8">
    <a href="{{ route('admin.appointments.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium inline-flex items-center gap-1 mb-2">
        <i class="fas fa-arrow-left"></i> Back to Appointments
    </a>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <h1 class="text-xl md:text-2xl font-bold text-gray-900">Appointment Details</h1>
        <div class="flex items-center gap-3">
            <span class="px-4 py-1.5 rounded-full text-sm font-medium {{ $appointment->status_badge }} self-start sm:self-auto">
                {{ ucfirst($appointment->status) }}
            </span>
            <a href="{{ route('admin.appointments.edit', $appointment) }}" class="bg-amber-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-amber-600 transition text-sm inline-flex items-center gap-2">
                <i class="fas fa-pen"></i> Edit
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
    {{-- Patient Information --}}
    <div class="lg:col-span-2 space-y-4 md:space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
            <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Patient Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                @if($appointment->patient)
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Patient ID</label>
                        <a href="{{ route('admin.patients.show', $appointment->patient) }}" class="text-primary-600 hover:text-primary-700 font-mono font-semibold text-sm">{{ $appointment->patient->patient_id }}</a>
                    </div>
                @endif
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Full Name</label>
                    <p class="text-gray-900 font-medium text-sm">{{ $appointment->patient_name }}</p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Phone</label>
                    <p class="text-gray-900">
                        <a href="tel:{{ $appointment->phone }}" class="text-primary-600 hover:text-primary-700 text-sm">{{ $appointment->phone }}</a>
                    </p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Email</label>
                    <p class="text-gray-900 text-sm">
                        @if($appointment->email)
                            <a href="mailto:{{ $appointment->email }}" class="text-primary-600 hover:text-primary-700">{{ $appointment->email }}</a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Age / Gender</label>
                    <p class="text-gray-900 text-sm">{{ $appointment->age ?: '-' }} / {{ $appointment->gender ? ucfirst($appointment->gender) : '-' }}</p>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs text-gray-500 mb-1">Address</label>
                    <p class="text-gray-900 text-sm">{{ $appointment->address ?: '-' }}</p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Service</label>
                    <p class="text-gray-900 text-sm">{{ $appointment->department ?: '-' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
            <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Appointment Details</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Preferred Date</label>
                    <p class="text-gray-900 font-medium text-sm">{{ $appointment->preferred_date->format('l, M d, Y') }}</p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Preferred Time</label>
                    <p class="text-gray-900 font-medium text-sm">{{ $appointment->preferred_time }}</p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Doctor</label>
                    <p class="text-gray-900 text-sm">{{ $appointment->doctor->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Created</label>
                    <p class="text-gray-900 text-sm">{{ $appointment->created_at->format('M d, Y h:i A') }}</p>
                </div>
            </div>
            @if($appointment->message)
                <div class="mt-4">
                    <label class="block text-xs text-gray-500 mb-1">Message</label>
                    <p class="text-gray-700 bg-gray-50 rounded-lg p-3 text-sm">{{ $appointment->message }}</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-4 md:space-y-6">
        {{-- Quick Actions --}}
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
            <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-3">Quick Actions</h2>
            <div class="grid grid-cols-3 gap-2">
                <a href="tel:{{ $appointment->phone }}" class="flex flex-col items-center gap-1.5 bg-green-50 text-green-700 px-3 py-3 rounded-lg font-medium hover:bg-green-100 transition text-xs">
                    <i class="fas fa-phone"></i> Call
                </a>
                @if($appointment->email)
                    <a href="mailto:{{ $appointment->email }}" class="flex flex-col items-center gap-1.5 bg-blue-50 text-blue-700 px-3 py-3 rounded-lg font-medium hover:bg-blue-100 transition text-xs">
                        <i class="fas fa-envelope"></i> Email
                    </a>
                @endif
                <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" onsubmit="event.preventDefault(); swalConfirm(this, 'Delete Appointment?', 'This action cannot be undone.')" class="{{ !$appointment->email ? 'col-span-2' : '' }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full flex flex-col items-center gap-1.5 bg-red-50 text-red-700 px-3 py-3 rounded-lg font-medium hover:bg-red-100 transition text-xs">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        {{-- Patient Quick Link --}}
        @if($appointment->patient)
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
                <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-3">Patient</h2>
                <a href="{{ route('admin.patients.show', $appointment->patient) }}" class="block p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                    <p class="text-sm font-medium text-gray-900">{{ $appointment->patient->name }}</p>
                    <p class="text-xs text-primary-600 font-mono">{{ $appointment->patient->patient_id }}</p>
                </a>
            </div>
        @endif

        {{-- Status Update --}}
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
            <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-3">Update Status</h2>
            <form action="{{ route('admin.appointments.update-status', $appointment) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="space-y-2">
                    <label class="flex items-center gap-3 p-2.5 border rounded-lg cursor-pointer hover:bg-gray-50 transition text-sm {{ $appointment->status === 'pending' ? 'border-yellow-300 bg-yellow-50' : 'border-gray-200' }}">
                        <input type="radio" name="status" value="pending" {{ $appointment->status === 'pending' ? 'checked' : '' }} class="text-yellow-600 focus:ring-yellow-500">
                        <span class="font-medium text-gray-700">Pending</span>
                    </label>
                    <label class="flex items-center gap-3 p-2.5 border rounded-lg cursor-pointer hover:bg-gray-50 transition text-sm {{ $appointment->status === 'confirmed' ? 'border-blue-300 bg-blue-50' : 'border-gray-200' }}">
                        <input type="radio" name="status" value="confirmed" {{ $appointment->status === 'confirmed' ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                        <span class="font-medium text-gray-700">Confirmed</span>
                    </label>
                    <label class="flex items-center gap-3 p-2.5 border rounded-lg cursor-pointer hover:bg-gray-50 transition text-sm {{ $appointment->status === 'completed' ? 'border-green-300 bg-green-50' : 'border-gray-200' }}">
                        <input type="radio" name="status" value="completed" {{ $appointment->status === 'completed' ? 'checked' : '' }} class="text-green-600 focus:ring-green-500">
                        <span class="font-medium text-gray-700">Completed</span>
                    </label>
                    <label class="flex items-center gap-3 p-2.5 border rounded-lg cursor-pointer hover:bg-gray-50 transition text-sm {{ $appointment->status === 'cancelled' ? 'border-red-300 bg-red-50' : 'border-gray-200' }}">
                        <input type="radio" name="status" value="cancelled" {{ $appointment->status === 'cancelled' ? 'checked' : '' }} class="text-red-600 focus:ring-red-500">
                        <span class="font-medium text-gray-700">Cancelled</span>
                    </label>
                </div>
                <button type="submit" class="w-full mt-3 bg-primary-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-primary-700 transition text-sm">
                    Update Status
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
