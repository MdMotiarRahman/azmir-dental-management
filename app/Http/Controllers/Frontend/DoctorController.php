<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Services\ContactInfoService;
use App\Services\DoctorService;

class DoctorController extends Controller
{
    public function __construct(
        private DoctorService $doctorService,
        private ContactInfoService $contactInfoService,
    ) {}

    public function index()
    {
        $doctors = $this->doctorService->getAllDoctors();
        $contactInfo = $this->contactInfoService->getContactInfo();

        return view('frontend.doctors', compact('doctors', 'contactInfo'));
    }

    public function show(Doctor $doctor)
    {
        $contactInfo = $this->contactInfoService->getContactInfo();

        return view('frontend.doctor-detail', compact('doctor', 'contactInfo'));
    }
}
