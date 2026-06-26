<?php

namespace App\Services;

use App\Models\Doctor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;

class DoctorService
{
    public function getAllDoctors(): LengthAwarePaginator
    {
        return Doctor::latest()->paginate(10);
    }

    public function getActiveDoctors(): Builder
    {
        return Doctor::query();
    }

    public function getDoctorById(int $id): Doctor
    {
        return Doctor::findOrFail($id);
    }

    public function createDoctor(array $data, ?UploadedFile $photo = null): Doctor
    {
        if ($photo) {
            $data['photo'] = $photo->store('doctors', 'public');
        }

        return Doctor::create($data);
    }

    public function updateDoctor(Doctor $doctor, array $data, ?UploadedFile $photo = null): Doctor
    {
        if ($photo) {
            if ($doctor->photo) {
                \Storage::disk('public')->delete($doctor->photo);
            }
            $data['photo'] = $photo->store('doctors', 'public');
        }

        $doctor->update($data);

        return $doctor->fresh();
    }

    public function deleteDoctor(Doctor $doctor): bool
    {
        if ($doctor->photo) {
            \Storage::disk('public')->delete($doctor->photo);
        }

        return $doctor->delete();
    }

    public function searchDoctors(string $query): LengthAwarePaginator
    {
        return Doctor::where('name', 'like', "%{$query}%")
            ->orWhere('specialization', 'like', "%{$query}%")
            ->latest()
            ->paginate(10);
    }

    public function getDoctorCount(): int
    {
        return Doctor::count();
    }
}
