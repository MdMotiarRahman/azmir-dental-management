@extends('layouts.admin')

@section('title', 'Manage Patients')

@section('content')
<div class="mb-6 md:mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h1 class="text-xl md:text-2xl font-bold text-gray-900">Patients</h1>
            <p class="text-gray-600 text-sm">Manage patient records</p>
        </div>
        <a href="{{ route('admin.patients.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-700 transition text-sm inline-flex items-center gap-2 self-start">
            <i class="fas fa-plus"></i> New Patient
        </a>
    </div>
</div>

{{-- Search --}}
<div class="bg-white rounded-xl shadow-sm p-3 md:p-4 mb-4 md:mb-6">
    <form action="{{ route('admin.patients.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search by ID, name, phone, email..."
            class="flex-1 border border-gray-300 rounded-lg px-3 md:px-4 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
        <div class="flex gap-3">
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-700 transition text-sm">
                <i class="fas fa-search"></i>
            </button>
            @if($search)
                <a href="{{ route('admin.patients.index') }}" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-lg font-medium hover:bg-gray-300 transition text-sm">
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Blood</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Appointments</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($patients as $patient)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-1 bg-primary-50 text-primary-700 rounded-md text-xs font-mono font-semibold">{{ $patient->patient_id }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.patients.show', $patient) }}" class="text-sm font-medium text-gray-900 hover:text-primary-600">{{ $patient->name }}</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $patient->phone }}</div>
                            <div class="text-xs text-gray-500">{{ $patient->email ?: '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $patient->gender ? ucfirst($patient->gender) : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $patient->age ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $patient->blood_group_display }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $patient->appointments_count }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.patients.show', $patient) }}" class="text-blue-600 hover:text-blue-800" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.patients.edit', $patient) }}" class="text-amber-600 hover:text-amber-800" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.patients.destroy', $patient) }}" method="POST" class="inline" onsubmit="event.preventDefault(); swalConfirm(this, 'Delete Patient?', 'This will permanently remove this patient and all associated appointments.')">
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
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">No patients found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $patients->links() }}</div>
</div>

{{-- Mobile Cards --}}
<div class="md:hidden space-y-3">
    @forelse($patients as $patient)
        <div class="bg-white rounded-xl shadow-sm p-4">
            <div class="flex items-start justify-between mb-2">
                <div>
                    <span class="px-2 py-0.5 bg-primary-50 text-primary-700 rounded text-[10px] font-mono font-semibold">{{ $patient->patient_id }}</span>
                    <a href="{{ route('admin.patients.show', $patient) }}">
                        <p class="text-sm font-semibold text-gray-900 mt-1 hover:text-primary-600">{{ $patient->name }}</p>
                    </a>
                </div>
                <span class="text-xs text-gray-500">{{ $patient->appointments_count }} appts</span>
            </div>
            <div class="grid grid-cols-2 gap-1.5 text-xs text-gray-500 mb-3">
                <span class="flex items-center gap-1"><i class="fas fa-phone"></i> {{ $patient->phone }}</span>
                <span class="flex items-center gap-1"><i class="fas fa-venus-mars"></i> {{ $patient->gender ? ucfirst($patient->gender) : '-' }}</span>
                <span class="flex items-center gap-1"><i class="fas fa-birthday-cake"></i> {{ $patient->age ?? '-' }} yrs</span>
                <span class="flex items-center gap-1"><i class="fas fa-tint"></i> {{ $patient->blood_group_display }}</span>
            </div>
            <div class="flex items-center gap-2 pt-2 border-t border-gray-100">
                <a href="{{ route('admin.patients.show', $patient) }}" class="flex-1 text-center bg-blue-50 text-blue-700 px-3 py-2 rounded-lg font-medium hover:bg-blue-100 transition text-xs">
                    <i class="fas fa-eye"></i> View
                </a>
                <a href="{{ route('admin.patients.edit', $patient) }}" class="flex-1 text-center bg-amber-50 text-amber-700 px-3 py-2 rounded-lg font-medium hover:bg-amber-100 transition text-xs">
                    <i class="fas fa-pen"></i> Edit
                </a>
                <form action="{{ route('admin.patients.destroy', $patient) }}" method="POST" onsubmit="event.preventDefault(); swalConfirm(this, 'Delete Patient?', 'This will permanently remove this patient.')" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-50 text-red-700 px-3 py-2 rounded-lg font-medium hover:bg-red-100 transition text-xs">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-xl shadow-sm p-8 text-center text-gray-500 text-sm">No patients found.</div>
    @endforelse
    <div class="mt-4">{{ $patients->links() }}</div>
</div>
@endsection
