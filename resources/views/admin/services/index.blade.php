@extends('layouts.admin')

@section('title', 'Manage Services')

@section('content')
<div class="flex items-center justify-between mb-6 md:mb-8">
    <div>
        <h1 class="text-xl md:text-2xl font-bold text-gray-900">Services</h1>
        <p class="text-gray-600 text-sm">Manage hospital services</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="bg-primary-600 text-white px-3 md:px-5 py-2 md:py-2.5 rounded-lg font-medium hover:bg-primary-700 transition flex items-center gap-2 text-sm">
        <i class="fas fa-plus text-xs md:text-sm"></i> <span class="hidden sm:inline">Add</span> Service
    </a>
</div>

{{-- Desktop Table --}}
<div class="hidden md:block bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($services as $service)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                @if($service->image)
                                    <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-12 h-12 rounded-lg object-cover">
                                @else
                                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                        <i class="{{ $service->icon ?? 'fas fa-medkit' }} text-primary-600"></i>
                                    </div>
                                @endif
                                <div class="text-sm font-medium text-gray-900">{{ $service->title }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <i class="{{ $service->icon ?? 'fas fa-medkit' }}"></i>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate">{{ Str::limit($service->description, 80) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline" onsubmit="event.preventDefault(); swalConfirm(this, 'Delete Service?', 'This will permanently remove this service.')">
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
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">No services found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $services->links() }}</div>
</div>

{{-- Mobile Cards --}}
<div class="md:hidden space-y-3">
    @forelse($services as $service)
        <div class="bg-white rounded-xl shadow-sm p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        @if($service->image)
                            <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-full h-full object-cover rounded-lg">
                        @else
                            <i class="{{ $service->icon ?? 'fas fa-medkit' }} text-primary-600"></i>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $service->title }}</p>
                        <p class="text-xs text-gray-500 line-clamp-1">{{ Str::limit($service->description, 50) }}</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2 justify-end">
                <a href="{{ route('admin.services.edit', $service) }}" class="w-8 h-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-edit text-sm"></i>
                </a>
                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="event.preventDefault(); swalConfirm(this, 'Delete Service?', 'This will permanently remove this service.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-8 h-8 bg-red-50 text-red-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-trash text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-xl shadow-sm p-8 text-center text-gray-500 text-sm">No services found.</div>
    @endforelse
    <div class="mt-4">{{ $services->links() }}</div>
</div>
@endsection
