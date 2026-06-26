<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Services\AppointmentService;
use App\Services\ContactInfoService;
use App\Services\DoctorService;
use Illuminate\Http\RedirectResponse;

class AppointmentController extends Controller
{
    public function __construct(
        private AppointmentService $appointmentService,
        private DoctorService $doctorService,
        private ContactInfoService $contactInfoService,
    ) {}

    public function create()
    {
        $doctors = $this->doctorService->getActiveDoctors()->get();
        $contactInfo = $this->contactInfoService->getContactInfo();

        return view('frontend.appointment', compact('doctors', 'contactInfo'));
    }

    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        $this->appointmentService->createAppointment($request->validated());

        return redirect()->route('appointment.create')
            ->with('success', 'Your appointment has been submitted successfully. We will contact you shortly.');
    }
}
