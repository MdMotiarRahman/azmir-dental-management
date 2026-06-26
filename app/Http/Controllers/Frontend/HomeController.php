<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use App\Services\ContactInfoService;
use App\Services\DoctorService;
use App\Services\ServiceService;

class HomeController extends Controller
{
    public function __construct(
        private DoctorService $doctorService,
        private ServiceService $serviceService,
        private AppointmentService $appointmentService,
        private ContactInfoService $contactInfoService,
    ) {}

    public function index()
    {
        $doctors = $this->doctorService->getActiveDoctors()->latest()->take(6)->get();
        $services = $this->serviceService->getActiveServices()->take(6);
        $contactInfo = $this->contactInfoService->getContactInfo();

        return view('frontend.home', compact('doctors', 'services', 'contactInfo'));
    }
}
