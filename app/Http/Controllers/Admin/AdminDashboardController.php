<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use App\Services\DoctorService;
use App\Services\ServiceService;

class AdminDashboardController extends Controller
{
    public function __construct(
        private DoctorService $doctorService,
        private ServiceService $serviceService,
        private AppointmentService $appointmentService,
    ) {}

    public function index()
    {
        $totalDoctors = $this->doctorService->getDoctorCount();
        $totalServices = $this->serviceService->getServiceCount();
        $totalAppointments = $this->appointmentService->getTotalCount();
        $todayAppointments = $this->appointmentService->getTodayCount();
        $pendingAppointments = $this->appointmentService->getPendingCount();
        $recentAppointments = $this->appointmentService->getRecentAppointments(10);

        return view('admin.dashboard', compact(
            'totalDoctors',
            'totalServices',
            'totalAppointments',
            'todayAppointments',
            'pendingAppointments',
            'recentAppointments',
        ));
    }
}
