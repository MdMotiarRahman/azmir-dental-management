@extends('layouts.admin')

@section('title', 'Patient Details')

@section('content')
<div class="mb-6 md:mb-8">
    <a href="{{ route('admin.patients.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium inline-flex items-center gap-1 mb-2">
        <i class="fas fa-arrow-left"></i> Back to Patients
    </a>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h1 class="text-xl md:text-2xl font-bold text-gray-900">{{ $patient->name }}</h1>
            <p class="text-gray-600 text-sm">Patient <span class="font-mono font-semibold text-primary-600">{{ $patient->patient_id }}</span></p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.patients.edit', $patient) }}" class="bg-amber-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-amber-600 transition text-sm inline-flex items-center gap-2">
                <i class="fas fa-pen"></i> Edit
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
    {{-- Patient Info --}}
    <div class="lg:col-span-2 space-y-4 md:space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
            <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Personal Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Patient ID</label>
                    <p class="text-primary-700 font-mono font-semibold text-sm">{{ $patient->patient_id }}</p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Full Name</label>
                    <p class="text-gray-900 font-medium text-sm">{{ $patient->name }}</p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Phone</label>
                    <p class="text-gray-900">
                        <a href="tel:{{ $patient->phone }}" class="text-primary-600 hover:text-primary-700 text-sm">{{ $patient->phone }}</a>
                    </p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Email</label>
                    <p class="text-gray-900 text-sm">
                        @if($patient->email)
                            <a href="mailto:{{ $patient->email }}" class="text-primary-600 hover:text-primary-700">{{ $patient->email }}</a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Gender</label>
                    <p class="text-gray-900 text-sm">{{ $patient->gender ? ucfirst($patient->gender) : '-' }}</p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Date of Birth / Age</label>
                    <p class="text-gray-900 text-sm">
                        @if($patient->date_of_birth)
                            {{ $patient->date_of_birth->format('M d, Y') }} <span class="text-gray-500">({{ $patient->age }} yrs)</span>
                        @else
                            -
                        @endif
                    </p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Blood Group</label>
                    <p class="text-gray-900 text-sm">{{ $patient->blood_group_display }}</p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Registered</label>
                    <p class="text-gray-900 text-sm">{{ $patient->created_at->format('M d, Y') }}</p>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs text-gray-500 mb-1">Address</label>
                    <p class="text-gray-900 text-sm">{{ $patient->address ?: '-' }}</p>
                </div>
            </div>
        </div>

        @if($patient->medical_notes)
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
                <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-3">Medical Notes</h2>
                <p class="text-gray-700 bg-gray-50 rounded-lg p-3 text-sm">{{ $patient->medical_notes }}</p>
            </div>
        @endif

        {{-- Appointment History --}}
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base md:text-lg font-semibold text-gray-900">Appointment History</h2>
                <span class="px-3 py-1 bg-primary-50 text-primary-700 rounded-full text-xs font-medium">{{ $patient->appointments->count() }} total</span>
            </div>
            @if($patient->appointments->isEmpty())
                <p class="text-gray-500 text-sm text-center py-6">No appointments yet.</p>
            @else
                <div class="space-y-3">
                    @foreach($patient->appointments as $appointment)
                        <a href="{{ route('admin.appointments.show', $appointment) }}" class="block p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                            <div class="flex items-start justify-between mb-1">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $appointment->preferred_date->format('M d, Y') }} at {{ $appointment->preferred_time }}
                                </div>
                                <span class="px-2 py-0.5 rounded-full text-[11px] font-medium {{ $appointment->status_badge }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </div>
                            <div class="flex items-center gap-3 text-xs text-gray-500">
                                <span><i class="fas fa-user-md"></i> {{ $appointment->doctor->name ?? 'N/A' }}</span>
                                @if($appointment->department)
                                    <span><i class="fas fa-tooth"></i> {{ $appointment->department }}</span>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-4 md:space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
            <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-3">Quick Actions</h2>
            <div class="space-y-2">
                <a href="tel:{{ $patient->phone }}" class="flex items-center gap-3 bg-green-50 text-green-700 px-4 py-3 rounded-lg font-medium hover:bg-green-100 transition text-sm">
                    <i class="fas fa-phone"></i> Call Patient
                </a>
                @if($patient->email)
                    <a href="mailto:{{ $patient->email }}" class="flex items-center gap-3 bg-blue-50 text-blue-700 px-4 py-3 rounded-lg font-medium hover:bg-blue-100 transition text-sm">
                        <i class="fas fa-envelope"></i> Email Patient
                    </a>
                @endif
                <a href="{{ route('admin.appointments.create', ['patient_id' => $patient->id]) }}" class="flex items-center gap-3 bg-primary-50 text-primary-700 px-4 py-3 rounded-lg font-medium hover:bg-primary-100 transition text-sm">
                    <i class="fas fa-calendar-plus"></i> Book Appointment
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
            <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-3">Actions</h2>
            <div class="space-y-2">
                <a href="{{ route('admin.patients.edit', $patient) }}" class="w-full flex items-center justify-center gap-2 bg-amber-500 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-amber-600 transition text-sm">
                    <i class="fas fa-pen"></i> Edit Patient
                </a>
                <form action="{{ route('admin.patients.destroy', $patient) }}" method="POST" onsubmit="event.preventDefault(); swalConfirm(this, 'Delete Patient?', 'This will permanently remove this patient and all associated appointments.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-50 text-red-700 px-4 py-2.5 rounded-lg font-medium hover:bg-red-100 transition text-sm">
                        <i class="fas fa-trash"></i> Delete Patient
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
