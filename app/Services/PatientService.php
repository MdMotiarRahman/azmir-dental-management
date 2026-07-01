<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class PatientService
{
    public function getAllPatients(?string $search = null): LengthAwarePaginator
    {
        $query = Patient::withCount('appointments');

        if ($search) {
            $query->where(function (Builder $q) use ($search) {
                $q->where('patient_id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate(15);
    }

    public function getPatientById(int $id): Patient
    {
        return Patient::withCount('appointments')->with('appointments')->findOrFail($id);
    }

    public function createPatient(array $data): Patient
    {
        return Patient::create($data);
    }

    public function updatePatient(Patient $patient, array $data): Patient
    {
        $patient->update($data);

        return $patient->fresh();
    }

    public function deletePatient(Patient $patient): bool
    {
        return $patient->delete();
    }

    public function getTotalCount(): int
    {
        return Patient::count();
    }

    public function getPatientByPhone(string $phone): ?Patient
    {
        return Patient::where('phone', $phone)->first();
    }

    public function getRecentPatients(int $limit = 5)
    {
        return Patient::latest()->take($limit)->get();
    }
}
