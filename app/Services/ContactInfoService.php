<?php

namespace App\Services;

use App\Models\ContactInformation;

class ContactInfoService
{
    public function getContactInfo(): ?ContactInformation
    {
        return ContactInformation::first();
    }

    public function updateOrCreate(array $data): ContactInformation
    {
        $contactInfo = ContactInformation::first();

        if ($contactInfo) {
            $contactInfo->update($data);
            return $contactInfo->fresh();
        }

        return ContactInformation::create($data);
    }
}
