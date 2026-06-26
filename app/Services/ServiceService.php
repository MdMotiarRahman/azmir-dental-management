<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;

class ServiceService
{
    public function getAllServices(): LengthAwarePaginator
    {
        return Service::latest()->paginate(10);
    }

    public function getActiveServices()
    {
        return Service::all();
    }

    public function getServiceById(int $id): Service
    {
        return Service::findOrFail($id);
    }

    public function createService(array $data, ?UploadedFile $image = null): Service
    {
        if ($image) {
            $data['image'] = $image->store('services', 'public');
        }

        return Service::create($data);
    }

    public function updateService(Service $service, array $data, ?UploadedFile $image = null): Service
    {
        if ($image) {
            if ($service->image) {
                \Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $image->store('services', 'public');
        }

        $service->update($data);

        return $service->fresh();
    }

    public function deleteService(Service $service): bool
    {
        if ($service->image) {
            \Storage::disk('public')->delete($service->image);
        }

        return $service->delete();
    }

    public function getServiceCount(): int
    {
        return Service::count();
    }
}
