@extends('layouts.admin')

@section('title', 'Edit Patient')

@section('content')
<div class="mb-6 md:mb-8">
    <a href="{{ route('admin.patients.show', $patient) }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium inline-flex items-center gap-1 mb-2">
        <i class="fas fa-arrow-left"></i> Back to Patient
    </a>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h1 class="text-xl md:text-2xl font-bold text-gray-900">Edit Patient</h1>
            <p class="text-gray-600 text-sm">Update records for <span class="font-mono font-semibold text-primary-600">{{ $patient->patient_id }}</span></p>
        </div>
        <span class="px-3 py-1 bg-primary-50 text-primary-700 rounded-lg text-sm font-mono font-semibold self-start">{{ $patient->patient_id }}</span>
    </div>
</div>

<form action="{{ route('admin.patients.update', $patient) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
        <div class="lg:col-span-2 space-y-4 md:space-y-6">
            {{-- Personal Information --}}
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
                <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Personal Information</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('name') border-red-500 @enderror">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $patient->phone) }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('phone') border-red-500 @enderror">
                        @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $patient->email) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('email') border-red-500 @enderror">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                        <select name="gender" id="gender" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('gender') border-red-500 @enderror">
                            <option value="">Select</option>
                            <option value="male" {{ old('gender', $patient->gender) === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $patient->gender) === 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $patient->gender) === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth?->format('Y-m-d')) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('date_of_birth') border-red-500 @enderror">
                        @error('date_of_birth')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Medical Details --}}
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
                <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Medical Details</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="blood_group" class="block text-sm font-medium text-gray-700 mb-1">Blood Group</label>
                        <select name="blood_group" id="blood_group" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('blood_group') border-red-500 @enderror">
                            <option value="">Select</option>
                            @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $group)
                                <option value="{{ $group }}" {{ old('blood_group', $patient->blood_group) === $group ? 'selected' : '' }}>{{ $group }}</option>
                            @endforeach
                        </select>
                        @error('blood_group')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <textarea name="address" id="address" rows="2"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('address') border-red-500 @enderror">{{ old('address', $patient->address) }}</textarea>
                        @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="medical_notes" class="block text-sm font-medium text-gray-700 mb-1">Medical Notes</label>
                        <textarea name="medical_notes" id="medical_notes" rows="3" placeholder="Any relevant medical history, allergies, etc."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('medical_notes') border-red-500 @enderror">{{ old('medical_notes', $patient->medical_notes) }}</textarea>
                        @error('medical_notes')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="space-y-4 md:space-y-6">
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
                <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-3">Actions</h2>
                <div class="space-y-2">
                    <button type="submit" class="w-full bg-primary-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-primary-700 transition text-sm">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <a href="{{ route('admin.patients.show', $patient) }}" class="block w-full text-center bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg font-medium hover:bg-gray-300 transition text-sm">
                        Cancel
                    </a>
                    <form action="{{ route('admin.patients.destroy', $patient) }}" method="POST" onsubmit="event.preventDefault(); swalConfirm(this, 'Delete Patient?', 'This will permanently remove this patient record.')">
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
</form>
@endsection
