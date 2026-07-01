@extends('layouts.admin')

@section('title', 'Manage Doctors')

@section('content')
<div class="flex items-center justify-between mb-6 md:mb-8">
    <div>
        <h1 class="text-xl md:text-2xl font-bold text-gray-900">Doctors</h1>
        <p class="text-gray-600 text-sm">Manage hospital doctors</p>
    </div>
    <a href="{{ route('admin.doctors.create') }}" class="bg-primary-600 text-white px-3 md:px-5 py-2 md:py-2.5 rounded-lg font-medium hover:bg-primary-700 transition flex items-center gap-2 text-sm">
        <i class="fas fa-plus text-xs md:text-sm"></i> <span class="hidden sm:inline">Add</span> Doctor
    </a>
</div>

{{-- Search --}}
<div class="bg-white rounded-xl shadow-sm p-3 md:p-4 mb-4 md:mb-6">
    <form action="{{ route('admin.doctors.index') }}" method="GET" class="flex gap-3">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search doctors..."
            class="flex-1 border border-gray-300 rounded-lg px-3 md:px-4 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
        <button type="submit" class="bg-primary-600 text-white px-3 md:px-5 py-2 rounded-lg font-medium hover:bg-primary-700 transition text-sm">
            <i class="fas fa-search"></i>
        </button>
        @if($search)
            <a href="{{ route('admin.doctors.index') }}" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-lg font-medium hover:bg-gray-300 transition text-sm">
                Clear
            </a>
        @endif
    </form>
</div>

{{-- Desktop Table --}}
<div class="hidden md:block bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialization</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qualification</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reg. No.</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($doctors as $doctor)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden flex-shrink-0">
                                    @if($doctor->photo)
                                        <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-primary-100">
                                            <i class="fas fa-user text-primary-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $doctor->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $doctor->visiting_hours }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $doctor->specialization }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $doctor->qualification }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $doctor->registration_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.doctors.edit', $doctor) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="inline" onsubmit="event.preventDefault(); swalConfirm(this, 'Delete Doctor?', 'This will permanently remove this doctor.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">No doctors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $doctors->links() }}</div>
</div>

{{-- Mobile Cards --}}
<div class="md:hidden space-y-3">
    @forelse($doctors as $doctor)
        <div class="bg-white rounded-xl shadow-sm p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-gray-200 rounded-full overflow-hidden flex-shrink-0">
                        @if($doctor->photo)
                            <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-primary-100">
                                <i class="fas fa-user text-primary-400"></i>
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $doctor->name }}</p>
                        <p class="text-xs text-primary-600">{{ $doctor->specialization }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.doctors.edit', $doctor) }}" class="w-8 h-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                    <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" onsubmit="event.preventDefault(); swalConfirm(this, 'Delete Doctor?', 'This will permanently remove this doctor.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-8 h-8 bg-red-50 text-red-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2 text-xs text-gray-500">
                <span class="flex items-center gap-1"><i class="fas fa-graduation-cap"></i> {{ $doctor->qualification }}</span>
                <span class="flex items-center gap-1"><i class="fas fa-id-card"></i> Reg. {{ $doctor->registration_number }}</span>
                <span class="flex items-center gap-1 col-span-2"><i class="fas fa-clock"></i> {{ $doctor->visiting_hours }}</span>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-xl shadow-sm p-8 text-center text-gray-500 text-sm">No doctors found.</div>
    @endforelse
    <div class="mt-4">{{ $doctors->links() }}</div>
</div>
@endsection
