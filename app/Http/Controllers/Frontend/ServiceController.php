<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\ContactInfoService;
use App\Services\ServiceService;

class ServiceController extends Controller
{
    public function __construct(
        private ServiceService $serviceService,
        private ContactInfoService $contactInfoService,
    ) {}

    public function index()
    {
        $services = $this->serviceService->getActiveServices();
        $contactInfo = $this->contactInfoService->getContactInfo();

        return view('frontend.services', compact('services', 'contactInfo'));
    }

    public function show(Service $service)
    {
        $contactInfo = $this->contactInfoService->getContactInfo();

        return view('frontend.service-detail', compact('service', 'contactInfo'));
    }
}
