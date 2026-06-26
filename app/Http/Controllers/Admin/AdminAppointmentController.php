<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAppointmentStatusRequest;
use App\Models\Appointment;
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

    public function show(Appointment $appointment)
    {
        $appointment->load('doctor');

        return view('admin.appointments.show', compact('appointment'));
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
