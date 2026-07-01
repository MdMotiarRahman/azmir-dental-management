<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePatientRequest;
use App\Http\Requests\Admin\UpdatePatientRequest;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Http\RedirectResponse;

class AdminPatientController extends Controller
{
    public function __construct(
        private PatientService $patientService,
    ) {}

    public function index(\Illuminate\Http\Request $request)
    {
        $search = $request->input('search');
        $patients = $this->patientService->getAllPatients($search);

        return view('admin.patients.index', compact('patients', 'search'));
    }

    public function create()
    {
        return view('admin.patients.create');
    }

    public function store(StorePatientRequest $request): RedirectResponse
    {
        $this->patientService->createPatient($request->validated());

        return redirect()->route('admin.patients.index')
            ->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        $patient->load('appointments.doctor');

        return view('admin.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient): RedirectResponse
    {
        $data = $request->validated();
        unset($data['patient_id']);

        $this->patientService->updatePatient($patient, $data);

        return redirect()->route('admin.patients.show', $patient->id)
            ->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient): RedirectResponse
    {
        $this->patientService->deletePatient($patient);

        return redirect()->route('admin.patients.index')
            ->with('success', 'Patient deleted successfully.');
    }
}
