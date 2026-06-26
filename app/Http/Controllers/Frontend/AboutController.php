<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\ContactInfoService;
use App\Services\DoctorService;
use App\Services\ServiceService;

class AboutController extends Controller
{
    public function __construct(
        private ContactInfoService $contactInfoService,
        private DoctorService $doctorService,
    ) {}

    public function index()
    {
        $contactInfo = $this->contactInfoService->getContactInfo();
        $doctors = $this->doctorService->getActiveDoctors()->latest()->take(4)->get();

        return view('frontend.about', compact('contactInfo', 'doctors'));
    }
}
