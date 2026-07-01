@extends('layouts.admin')

@section('title', 'Edit Doctor')

@section('content')
<div class="mb-6 md:mb-8">
    <a href="{{ route('admin.doctors.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium inline-flex items-center gap-1 mb-2">
        <i class="fas fa-arrow-left"></i> Back to Doctors
    </a>
    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Edit Doctor: {{ $doctor->name }}</h1>
</div>

<form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data" id="doctor-form">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
        {{-- Main Form --}}
        <div class="lg:col-span-2 space-y-4 md:space-y-6">
            {{-- Personal Info --}}
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
                <h2 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-user text-primary-500"></i> Personal Information
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $doctor->name) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('name') border-red-500 @enderror"
                            required>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="qualification" class="block text-sm font-medium text-gray-700 mb-1.5">Qualification <span class="text-red-500">*</span></label>
                        <input type="text" name="qualification" id="qualification" value="{{ old('qualification', $doctor->qualification) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('qualification') border-red-500 @enderror"
                            placeholder="e.g. BDS, MBBS" required>
                        @error('qualification') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="specialization" class="block text-sm font-medium text-gray-700 mb-1.5">Specialization <span class="text-red-500">*</span></label>
                        <input type="text" name="specialization" id="specialization" value="{{ old('specialization', $doctor->specialization) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('specialization') border-red-500 @enderror"
                            placeholder="e.g. Dental Surgery" required>
                        @error('specialization') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Professional Info --}}
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
                <h2 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-id-card text-primary-500"></i> Professional Details
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="registration_number" class="block text-sm font-medium text-gray-700 mb-1.5">BMDC Registration No. <span class="text-red-500">*</span></label>
                        <input type="text" name="registration_number" id="registration_number" value="{{ old('registration_number', $doctor->registration_number) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('registration_number') border-red-500 @enderror"
                            placeholder="e.g. 10448" required>
                        @error('registration_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="visiting_hours" class="block text-sm font-medium text-gray-700 mb-1.5">Visiting Hours <span class="text-red-500">*</span></label>
                        <input type="text" name="visiting_hours" id="visiting_hours" value="{{ old('visiting_hours', $doctor->visiting_hours) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('visiting_hours') border-red-500 @enderror"
                            placeholder="e.g. Morning: 10-2, Evening: 4-8" required>
                        @error('visiting_hours') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-1.5">Bio <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="bio" id="bio" rows="4" maxlength="1000"
                            class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('bio') border-red-500 @enderror"
                            placeholder="Brief description about the doctor...">{{ old('bio', $doctor->bio) }}</textarea>
                        <div class="flex justify-between items-center mt-1.5">
                            @error('bio') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                            <span class="text-xs text-gray-400 ml-auto"><span id="bio-count">{{ strlen($doctor->bio ?? '') }}</span>/1000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-4 md:space-y-6">
            {{-- Photo --}}
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
                <h2 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-camera text-primary-500"></i> Photo <span class="text-gray-400 font-normal text-xs">(optional)</span>
                </h2>
                <div class="flex flex-col items-center">
                    <div class="relative mb-4">
                        <div id="photo-preview" class="w-32 h-32 rounded-xl overflow-hidden bg-gray-100 flex items-center justify-center border-2 border-dashed border-gray-300">
                            @if($doctor->photo)
                                <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-user text-gray-300 text-4xl"></i>
                            @endif
                        </div>
                        <button type="button" id="remove-photo" onclick="removePhoto()" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition {{ $doctor->photo ? '' : 'hidden' }}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <label for="photo" class="cursor-pointer w-full">
                        <div class="bg-primary-50 text-primary-700 text-center py-2.5 rounded-lg font-medium text-sm hover:bg-primary-100 transition">
                            <i class="fas fa-upload mr-1.5"></i> {{ $doctor->photo ? 'Replace Photo' : 'Upload Photo' }}
                        </div>
                        <input type="file" name="photo" id="photo" accept="image/*" class="hidden" onchange="previewPhoto(this)">
                    </label>
                    <input type="hidden" name="remove_photo" id="remove_photo" value="0">
                    <p class="text-xs text-gray-400 mt-2 text-center">JPG, PNG or WebP. Max 2MB.</p>
                </div>
            </div>

            {{-- Actions --}}
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
                <h2 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-save text-primary-500"></i> Save Changes
                </h2>
                <div class="space-y-3">
                    <button type="submit" class="w-full bg-primary-600 text-white px-4 py-2.5 rounded-lg font-semibold hover:bg-primary-700 transition text-sm flex items-center justify-center gap-2">
                        <i class="fas fa-check"></i> Update Doctor
                    </button>
                    <a href="{{ route('admin.doctors.index') }}" class="block w-full bg-gray-100 text-gray-700 px-4 py-2.5 rounded-lg font-semibold hover:bg-gray-200 transition text-sm text-center">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    // Photo preview
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photo-preview').innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="w-full h-full object-cover">';
                document.getElementById('remove-photo').classList.remove('hidden');
                document.getElementById('remove_photo').value = '0';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Remove photo
    function removePhoto() {
        document.getElementById('photo-preview').innerHTML = '<i class="fas fa-user text-gray-300 text-4xl"></i>';
        document.getElementById('photo').value = '';
        document.getElementById('remove-photo').classList.add('hidden');
        document.getElementById('remove_photo').value = '1';
    }

    // Bio character count
    const bioField = document.getElementById('bio');
    const bioCount = document.getElementById('bio-count');
    bioField.addEventListener('input', function() {
        bioCount.textContent = this.value.length;
        if (this.value.length > 900) {
            bioCount.classList.add('text-amber-500');
            bioCount.classList.remove('text-gray-400');
        } else {
            bioCount.classList.remove('text-amber-500');
            bioCount.classList.add('text-gray-400');
        }
    });
</script>
@endpush
@endsection
