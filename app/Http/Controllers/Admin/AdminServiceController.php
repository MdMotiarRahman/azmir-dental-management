<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\RedirectResponse;

class AdminServiceController extends Controller
{
    public function __construct(
        private ServiceService $serviceService,
    ) {}

    public function index()
    {
        $services = $this->serviceService->getAllServices();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $this->serviceService->createService(
            $request->validated(),
            $request->file('image')
        );

        return redirect()->route('admin.services.index')
            ->with('success', 'Service added successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service): RedirectResponse
    {
        $this->serviceService->updateService(
            $service,
            $request->validated(),
            $request->file('image')
        );

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $this->serviceService->deleteService($service);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }
}
