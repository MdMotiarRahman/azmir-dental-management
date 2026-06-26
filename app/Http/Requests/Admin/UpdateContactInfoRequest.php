<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'whatsapp' => ['nullable', 'string', 'max:20'],
            'facebook' => ['nullable', 'url', 'max:500'],
            'google_map_embed' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
