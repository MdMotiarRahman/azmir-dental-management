@extends('layouts.admin')

@section('title', 'Add Service')

@section('content')
<div class="mb-6 md:mb-8">
    <a href="{{ route('admin.services.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium inline-flex items-center gap-1 mb-2">
        <i class="fas fa-arrow-left"></i> Back to Services
    </a>
    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Add New Service</h1>
</div>

<div class="bg-white rounded-xl shadow-sm p-4 md:p-8">
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1.5">Service Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('title') border-red-500 @enderror"
                    placeholder="e.g. Dental Implants" required>
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-1.5">Icon Class</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('icon') border-red-500 @enderror"
                    placeholder="e.g. fas fa-tooth">
                @error('icon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1.5">Image</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('image') border-red-500 @enderror">
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Description *</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('description') border-red-500 @enderror"
                    placeholder="Brief description of the service...">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="mt-6 md:mt-8 flex flex-col sm:flex-row gap-3">
            <button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-primary-700 transition text-sm">
                Add Service
            </button>
            <a href="{{ route('admin.services.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg font-semibold hover:bg-gray-300 transition text-sm text-center">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
