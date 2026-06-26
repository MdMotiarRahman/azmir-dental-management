@extends('layouts.admin')

@section('title', 'Edit Doctor')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.doctors.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium inline-flex items-center gap-1 mb-2">
        <i class="fas fa-arrow-left"></i> Back to Doctors
    </a>
    <h1 class="text-2xl font-bold text-gray-900">Edit Doctor: {{ $doctor->name }}</h1>
</div>

<div class="bg-white rounded-xl shadow-sm p-8">
    <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $doctor->name) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('name') border-red-500 @enderror"
                    required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                @if($doctor->photo)
                    <div class="mb-2">
                        <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="w-20 h-20 object-cover rounded-lg">
                    </div>
                @endif
                <input type="file" name="photo" id="photo" accept="image/*"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('photo') border-red-500 @enderror">
                @error('photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="qualification" class="block text-sm font-medium text-gray-700 mb-2">Qualification *</label>
                <input type="text" name="qualification" id="qualification" value="{{ old('qualification', $doctor->qualification) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('qualification') border-red-500 @enderror"
                    required>
                @error('qualification')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="specialization" class="block text-sm font-medium text-gray-700 mb-2">Specialization *</label>
                <input type="text" name="specialization" id="specialization" value="{{ old('specialization', $doctor->specialization) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('specialization') border-red-500 @enderror"
                    required>
                @error('specialization')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="registration_number" class="block text-sm font-medium text-gray-700 mb-2">Registration Number *</label>
                <input type="text" name="registration_number" id="registration_number" value="{{ old('registration_number', $doctor->registration_number) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('registration_number') border-red-500 @enderror"
                    required>
                @error('registration_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="visiting_hours" class="block text-sm font-medium text-gray-700 mb-2">Visiting Hours *</label>
                <input type="text" name="visiting_hours" id="visiting_hours" value="{{ old('visiting_hours', $doctor->visiting_hours) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('visiting_hours') border-red-500 @enderror"
                    required>
                @error('visiting_hours')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:col-span-2">
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                <textarea name="bio" id="bio" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('bio') border-red-500 @enderror">{{ old('bio', $doctor->bio) }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mt-8 flex gap-4">
            <button type="submit" class="bg-primary-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-700 transition">
                Update Doctor
            </button>
            <a href="{{ route('admin.doctors.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-300 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
