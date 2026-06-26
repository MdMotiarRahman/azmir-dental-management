<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateContactInfoRequest;
use App\Services\ContactInfoService;
use Illuminate\Http\RedirectResponse;

class AdminContactController extends Controller
{
    public function __construct(
        private ContactInfoService $contactInfoService,
    ) {}

    public function index()
    {
        $contactInfo = $this->contactInfoService->getContactInfo();

        return view('admin.contact.index', compact('contactInfo'));
    }

    public function update(UpdateContactInfoRequest $request): RedirectResponse
    {
        $this->contactInfoService->updateOrCreate($request->validated());

        return redirect()->route('admin.contact.index')
            ->with('success', 'Contact information updated successfully.');
    }
}
