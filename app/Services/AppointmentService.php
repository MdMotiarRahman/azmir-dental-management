<?php

namespace App\Services;

use App\Models\Appointment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class AppointmentService
{
    public function getAllAppointments(?string $search = null, ?string $status = null): LengthAwarePaginator
    {
        $query = Appointment::with('doctor');

        if ($search) {
            $query->where(function (Builder $q) use ($search) {
                $q->where('patient_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        return $query->latest()->paginate(15);
    }

    public function getAppointmentById(int $id): Appointment
    {
        return Appointment::with('doctor')->findOrFail($id);
    }

    public function createAppointment(array $data): Appointment
    {
        $data['status'] = 'pending';

        return Appointment::create($data);
    }

    public function updateStatus(Appointment $appointment, string $status): Appointment
    {
        $appointment->update(['status' => $status]);

        return $appointment->fresh();
    }

    public function deleteAppointment(Appointment $appointment): bool
    {
        return $appointment->delete();
    }

    public function getTotalCount(): int
    {
        return Appointment::count();
    }

    public function getTodayCount(): int
    {
        return Appointment::whereDate('preferred_date', today())->count();
    }

    public function getPendingCount(): int
    {
        return Appointment::where('status', 'pending')->count();
    }

    public function getRecentAppointments(int $limit = 5)
    {
        return Appointment::with('doctor')
            ->latest()
            ->take($limit)
            ->get();
    }
}
