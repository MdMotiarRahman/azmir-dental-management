<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAppointmentRequest;
use App\Http\Requests\Admin\UpdateAppointmentRequest;
use App\Http\Requests\Admin\UpdateAppointmentStatusRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Services\AppointmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminAppointmentController extends Controller
{
    public function __construct(
        private AppointmentService $appointmentService,
    ) {}

    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $appointments = $this->appointmentService->getAllAppointments($search, $status);

        return view('admin.appointments.index', compact('appointments', 'search', 'status'));
    }

    public function create(Request $request)
    {
        $doctors = Doctor::all();
        $patients = Patient::orderBy('name')->get();
        $selectedPatientId = $request->input('patient_id');

        return view('admin.appointments.create', compact('doctors', 'patients', 'selectedPatientId'));
    }

    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $patientId = $data['patient_id'] ?? null;
        $createNewPatient = $data['create_new_patient'] ?? false;

        if ($createNewPatient || !$patientId) {
            $patientData = [
                'name' => $data['patient_name'],
                'phone' => $data['phone'],
                'email' => $data['email'] ?? null,
                'gender' => $data['gender'] ?? null,
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'address' => $data['address'] ?? null,
            ];

            $patient = Patient::create($patientData);
            $data['patient_id'] = $patient->id;
        } else {
            $data['patient_id'] = $patientId;
        }

        unset($data['create_new_patient']);

        $this->appointmentService->createAppointment($data);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['doctor', 'patient']);

        return view('admin.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $appointment->load(['doctor', 'patient']);
        $doctors = Doctor::all();
        $patients = Patient::orderBy('name')->get();

        return view('admin.appointments.edit', compact('appointment', 'doctors', 'patients'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment): RedirectResponse
    {
        $data = $request->validated();

        $patientId = $data['patient_id'] ?? null;
        $createNewPatient = $data['create_new_patient'] ?? false;

        if ($createNewPatient || !$patientId) {
            $patientData = [
                'name' => $data['patient_name'],
                'phone' => $data['phone'],
                'email' => $data['email'] ?? null,
                'gender' => $data['gender'] ?? null,
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'address' => $data['address'] ?? null,
            ];

            $patient = Patient::create($patientData);
            $data['patient_id'] = $patient->id;
        } else {
            $data['patient_id'] = $patientId;
        }

        unset($data['create_new_patient']);

        $this->appointmentService->updateAppointment($appointment, $data);

        return redirect()->route('admin.appointments.show', $appointment)
            ->with('success', 'Appointment updated successfully.');
    }

    public function updateStatus(UpdateAppointmentStatusRequest $request, Appointment $appointment): RedirectResponse
    {
        $this->appointmentService->updateStatus($appointment, $request->validated()['status']);

        return redirect()->route('admin.appointments.show', $appointment)
            ->with('success', 'Appointment status updated successfully.');
    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
        $this->appointmentService->deleteAppointment($appointment);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}
