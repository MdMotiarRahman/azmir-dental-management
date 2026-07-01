@extends('layouts.admin')

@section('title', 'Manage Appointments')

@section('content')
<div class="mb-6 md:mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h1 class="text-xl md:text-2xl font-bold text-gray-900">Appointments</h1>
            <p class="text-gray-600 text-sm">Manage patient appointment requests</p>
        </div>
        <a href="{{ route('admin.appointments.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-700 transition text-sm inline-flex items-center gap-2 self-start">
            <i class="fas fa-plus"></i> New Appointment
        </a>
    </div>
</div>

{{-- Filters --}}
<div class="bg-white rounded-xl shadow-sm p-3 md:p-4 mb-4 md:mb-6">
    <form action="{{ route('admin.appointments.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search patient, phone..."
            class="flex-1 border border-gray-300 rounded-lg px-3 md:px-4 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
        <select name="status" class="border border-gray-300 rounded-lg px-3 md:px-4 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
            <option value="">All Status</option>
            <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ $status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <div class="flex gap-3">
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-700 transition text-sm">
                <i class="fas fa-search"></i>
            </button>
            @if($search || $status)
                <a href="{{ route('admin.appointments.index') }}" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-lg font-medium hover:bg-gray-300 transition text-sm">
                    Clear
                </a>
            @endif
        </div>
    </form>
</div>

{{-- Desktop Table --}}
<div class="hidden md:block bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age/Gender</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($appointments as $appointment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $appointment->patient_name }}</div>
                            <div class="text-sm text-gray-500">{{ $appointment->phone }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $appointment->age ?: '-' }} / {{ $appointment->gender ? ucfirst($appointment->gender) : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $appointment->doctor->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $appointment->department ?: '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <div>{{ $appointment->preferred_date->format('M d, Y') }}</div>
                            <div class="text-gray-500">{{ $appointment->preferred_time }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $appointment->status_badge }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.appointments.show', $appointment) }}" class="text-blue-600 hover:text-blue-800" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.appointments.edit', $appointment) }}" class="text-amber-600 hover:text-amber-800" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" class="inline" onsubmit="event.preventDefault(); swalConfirm(this, 'Delete Appointment?', 'This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $appointments->links() }}</div>
</div>

{{-- Mobile Cards --}}
<div class="md:hidden space-y-3">
    @forelse($appointments as $appointment)
        <div class="bg-white rounded-xl shadow-sm p-4">
            <div class="flex items-start justify-between mb-2">
                <div>
                    <p class="text-sm font-semibold text-gray-900">{{ $appointment->patient_name }}</p>
                    <p class="text-xs text-gray-500">{{ $appointment->phone }}</p>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[11px] font-medium {{ $appointment->status_badge }}">
                    {{ ucfirst($appointment->status) }}
                </span>
            </div>
            <div class="grid grid-cols-2 gap-1.5 text-xs text-gray-500 mb-3">
                <span class="flex items-center gap-1"><i class="fas fa-user"></i> {{ $appointment->age ?: '-' }} / {{ $appointment->gender ? ucfirst($appointment->gender) : '-' }}</span>
                <span class="flex items-center gap-1"><i class="fas fa-user-md"></i> {{ $appointment->doctor->name ?? 'N/A' }}</span>
                <span class="flex items-center gap-1"><i class="fas fa-tooth"></i> {{ $appointment->department ?: '-' }}</span>
                <span class="flex items-center gap-1"><i class="fas fa-calendar"></i> {{ $appointment->preferred_date->format('M d, Y') }}</span>
                <span class="flex items-center gap-1"><i class="fas fa-clock"></i> {{ $appointment->preferred_time }}</span>
            </div>
            <div class="flex items-center gap-2 pt-2 border-t border-gray-100">
                <a href="{{ route('admin.appointments.show', $appointment) }}" class="flex-1 text-center bg-blue-50 text-blue-700 px-3 py-2 rounded-lg font-medium hover:bg-blue-100 transition text-xs">
                    <i class="fas fa-eye"></i> View
                </a>
                <a href="{{ route('admin.appointments.edit', $appointment) }}" class="flex-1 text-center bg-amber-50 text-amber-700 px-3 py-2 rounded-lg font-medium hover:bg-amber-100 transition text-xs">
                    <i class="fas fa-pen"></i> Edit
                </a>
                <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" onsubmit="event.preventDefault(); swalConfirm(this, 'Delete Appointment?', 'This action cannot be undone.')" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-50 text-red-700 px-3 py-2 rounded-lg font-medium hover:bg-red-100 transition text-xs">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-xl shadow-sm p-8 text-center text-gray-500 text-sm">No appointments found.</div>
    @endforelse
    <div class="mt-4">{{ $appointments->links() }}</div>
</div>
@endsection
