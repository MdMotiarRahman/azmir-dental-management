<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'name',
        'phone',
        'email',
        'gender',
        'date_of_birth',
        'blood_group',
        'address',
        'medical_notes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (Patient $patient) {
            if (empty($patient->patient_id)) {
                $patient->patient_id = self::generatePatientId();
            }
        });
    }

    public static function generatePatientId(): string
    {
        $prefix = 'PAT-' . date('Y') . '-';
        $lastPatient = static::where('patient_id', 'like', $prefix . '%')
            ->orderByDesc('patient_id')
            ->first();

        if ($lastPatient) {
            $lastNumber = (int) substr($lastPatient->patient_id, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function getAgeAttribute(): ?int
    {
        return $this->date_of_birth ? $this->date_of_birth->age : null;
    }

    public function getBloodGroupDisplayAttribute(): string
    {
        return $this->blood_group ? strtoupper($this->blood_group) : '-';
    }
}
