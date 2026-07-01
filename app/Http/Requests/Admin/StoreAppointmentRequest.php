<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['nullable', 'exists:patients,id'],
            'create_new_patient' => ['nullable', 'boolean'],
            'patient_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'gender' => ['nullable', 'in:male,female,other'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'department' => ['nullable', 'string', 'max:255'],
            'preferred_date' => ['required', 'date'],
            'preferred_time' => ['required', 'date_format:H:i'],
            'message' => ['nullable', 'string', 'max:1000'],
            'status' => ['nullable', 'in:pending,confirmed,completed,cancelled'],
        ];
    }
}
