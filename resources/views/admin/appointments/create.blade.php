@extends('layouts.admin')

@section('title', 'New Appointment')

@section('content')
<div class="mb-6 md:mb-8">
    <a href="{{ route('admin.appointments.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium inline-flex items-center gap-1 mb-2">
        <i class="fas fa-arrow-left"></i> Back to Appointments
    </a>
    <h1 class="text-xl md:text-2xl font-bold text-gray-900">New Appointment</h1>
    <p class="text-gray-600 text-sm">Create a new patient appointment</p>
</div>

<form action="{{ route('admin.appointments.store') }}" method="POST">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
        {{-- Patient Info --}}
        <div class="lg:col-span-2 space-y-4 md:space-y-6">
            {{-- Patient Selection --}}
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
                <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Patient Selection</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search Existing Patient</label>
                        <div class="relative" id="patient-search-wrapper">
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                <input type="text" id="patient_search" placeholder="Search by name, phone, or patient ID..."
                                    class="w-full border border-gray-300 rounded-lg pl-9 pr-4 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                                    autocomplete="off" onfocus="showPatientDropdown()" oninput="filterPatients()">
                                <button type="button" id="patient_clear_btn" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden" onclick="clearPatientSearch()">
                                    <i class="fas fa-times text-sm"></i>
                                </button>
                            </div>
                            <input type="hidden" name="patient_id" id="patient_id" value="{{ old('patient_id', $selectedPatientId) }}">
                            <div id="patient_dropdown" class="absolute z-20 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg max-h-60 overflow-y-auto hidden">
                                @forelse($patients as $patient)
                                    <div class="patient-option px-4 py-3 hover:bg-primary-50 cursor-pointer border-b border-gray-100 last:border-0 transition"
                                        data-id="{{ $patient->id }}"
                                        data-name="{{ $patient->name }}"
                                        data-phone="{{ $patient->phone }}"
                                        data-email="{{ $patient->email ?? '' }}"
                                        data-gender="{{ $patient->gender ?? '' }}"
                                        data-dob="{{ $patient->date_of_birth?->format('Y-m-d') ?? '' }}"
                                        data-address="{{ $patient->address ?? '' }}"
                                        data-search="{{ strtolower($patient->patient_id . ' ' . $patient->name . ' ' . $patient->phone . ' ' . ($patient->email ?? '')) }}"
                                        onclick="selectPatient(this)">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span class="text-xs font-mono text-primary-600">{{ $patient->patient_id }}</span>
                                                <p class="text-sm font-medium text-gray-900">{{ $patient->name }}</p>
                                            </div>
                                            <span class="text-xs text-gray-500">{{ $patient->phone }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="px-4 py-3 text-sm text-gray-500 text-center">No patients registered yet.</div>
                                @endforelse
                            </div>
                        </div>
                        <div id="selected-patient-display" class="mt-2 hidden">
                            <div class="inline-flex items-center gap-2 bg-primary-50 text-primary-700 px-3 py-1.5 rounded-lg text-sm">
                                <i class="fas fa-user-check"></i>
                                <span id="selected-patient-text"></span>
                                <button type="button" onclick="clearPatientSelection()" class="ml-1 hover:text-primary-900"><i class="fas fa-times text-xs"></i></button>
                            </div>
                        </div>
                        @error('patient_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <hr class="flex-1 border-gray-200">
                        <span class="text-xs text-gray-500 font-medium uppercase">or create new</span>
                        <hr class="flex-1 border-gray-200">
                    </div>

                    <div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="create_new_patient" id="create_new_patient" value="1" {{ old('create_new_patient') ? 'checked' : '' }} onchange="toggleNewPatientFields()" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <span class="text-sm font-medium text-gray-700">Create new patient record</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Patient Details --}}
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-6" id="patient-details-section">
                <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Patient Information</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label for="patient_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="patient_name" id="patient_name" value="{{ old('patient_name') }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('patient_name') border-red-500 @enderror">
                        @error('patient_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('phone') border-red-500 @enderror">
                        @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('email') border-red-500 @enderror">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                        <select name="gender" id="gender" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('gender') border-red-500 @enderror">
                            <option value="">Select</option>
                            <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('date_of_birth') border-red-500 @enderror">
                        @error('date_of_birth')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <textarea name="address" id="address" rows="2"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                        @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Appointment Details --}}
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
                <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Appointment Details</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="doctor_id" class="block text-sm font-medium text-gray-700 mb-1">Doctor <span class="text-red-500">*</span></label>
                        <select name="doctor_id" id="doctor_id" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('doctor_id') border-red-500 @enderror">
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                        @error('doctor_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Service</label>
                        <input type="text" name="department" id="department" value="{{ old('department') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('department') border-red-500 @enderror">
                        @error('department')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="preferred_date" class="block text-sm font-medium text-gray-700 mb-1">Date <span class="text-red-500">*</span></label>
                        <input type="date" name="preferred_date" id="preferred_date" value="{{ old('preferred_date') }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('preferred_date') border-red-500 @enderror">
                        @error('preferred_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="preferred_time" class="block text-sm font-medium text-gray-700 mb-1">Time <span class="text-red-500">*</span></label>
                        <input type="time" name="preferred_time" id="preferred_time" value="{{ old('preferred_time') }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('preferred_time') border-red-500 @enderror">
                        @error('preferred_time')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('status') border-red-500 @enderror">
                            <option value="pending" {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea name="message" id="message" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                        @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
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
                        <i class="fas fa-save"></i> Create Appointment
                    </button>
                    <a href="{{ route('admin.appointments.index') }}" class="block w-full text-center bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg font-medium hover:bg-gray-300 transition text-sm">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    function filterPatients() {
        const query = document.getElementById('patient_search').value.toLowerCase().trim();
        const dropdown = document.getElementById('patient_dropdown');
        const options = dropdown.querySelectorAll('.patient-option');
        const clearBtn = document.getElementById('patient_clear_btn');

        clearBtn.classList.toggle('hidden', query === '');

        let hasVisible = false;
        options.forEach(option => {
            const match = option.dataset.search.includes(query);
            option.classList.toggle('hidden', !match);
            if (match) hasVisible = true;
        });

        dropdown.classList.toggle('hidden', !hasVisible && query === '');
        if (query !== '') dropdown.classList.remove('hidden');
    }

    function showPatientDropdown() {
        const query = document.getElementById('patient_search').value.toLowerCase().trim();
        if (query) {
            document.getElementById('patient_dropdown').classList.remove('hidden');
        }
    }

    function selectPatient(el) {
        document.getElementById('patient_id').value = el.dataset.id;
        document.getElementById('patient_search').value = el.dataset.name;
        document.getElementById('patient_dropdown').classList.add('hidden');

        document.getElementById('selected-patient-text').textContent = el.dataset.id + ' — ' + el.dataset.name + ' (' + el.dataset.phone + ')';
        document.getElementById('selected-patient-display').classList.remove('hidden');
        document.getElementById('patient_search').classList.add('hidden');
        document.getElementById('patient_clear_btn').classList.add('hidden');

        document.getElementById('create_new_patient').checked = false;
        document.getElementById('patient_name').value = el.dataset.name || '';
        document.getElementById('phone').value = el.dataset.phone || '';
        document.getElementById('email').value = el.dataset.email || '';
        document.getElementById('gender').value = el.dataset.gender || '';
        document.getElementById('date_of_birth').value = el.dataset.dob || '';
        document.getElementById('address').value = el.dataset.address || '';
    }

    function clearPatientSelection() {
        document.getElementById('patient_id').value = '';
        document.getElementById('selected-patient-display').classList.add('hidden');
        document.getElementById('patient_search').classList.remove('hidden');
        document.getElementById('patient_search').value = '';
        document.getElementById('patient_search').focus();

        document.getElementById('patient_name').value = '';
        document.getElementById('phone').value = '';
        document.getElementById('email').value = '';
        document.getElementById('gender').value = '';
        document.getElementById('date_of_birth').value = '';
        document.getElementById('address').value = '';
    }

    function clearPatientSearch() {
        document.getElementById('patient_search').value = '';
        document.getElementById('patient_clear_btn').classList.add('hidden');
        if (document.getElementById('patient_id').value) {
            clearPatientSelection();
        }
    }

    function toggleNewPatientFields() {
        const isNew = document.getElementById('create_new_patient').checked;

        if (isNew) {
            clearPatientSelection();
        }
    }

    document.addEventListener('click', function(e) {
        const wrapper = document.getElementById('patient-search-wrapper');
        if (!wrapper.contains(e.target)) {
            document.getElementById('patient_dropdown').classList.add('hidden');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        @if(old('patient_id', $selectedPatientId))
            (function() {
                const dropdown = document.getElementById('patient_dropdown');
                const selected = dropdown.querySelector('[data-id="{{ old('patient_id', $selectedPatientId) }}"]');
                if (selected) selectPatient(selected);
            })();
        @endif
        toggleNewPatientFields();
    });
</script>
@endpush
@endsection
