<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDoctorRequest;
use App\Http\Requests\Admin\UpdateDoctorRequest;
use App\Models\Doctor;
use App\Services\DoctorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminDoctorController extends Controller
{
    public function __construct(
        private DoctorService $doctorService,
    ) {}

    public function index(Request $request)
    {
        $search = $request->input('search');
        $doctors = $search
            ? $this->doctorService->searchDoctors($search)
            : $this->doctorService->getAllDoctors();

        return view('admin.doctors.index', compact('doctors', 'search'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(StoreDoctorRequest $request): RedirectResponse
    {
        $this->doctorService->createDoctor(
            $request->validated(),
            $request->file('photo')
        );

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor added successfully.');
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor): RedirectResponse
    {
        $this->doctorService->updateDoctor(
            $doctor,
            $request->validated(),
            $request->file('photo')
        );

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor): RedirectResponse
    {
        $this->doctorService->deleteDoctor($doctor);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor deleted successfully.');
    }
}
