<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\ContactMessage;
use App\Services\ContactInfoService;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function __construct(
        private ContactInfoService $contactInfoService,
    ) {}

    public function index()
    {
        $contactInfo = $this->contactInfoService->getContactInfo();

        return view('frontend.contact', compact('contactInfo'));
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        ContactMessage::create($request->validated());

        return redirect()->route('contact.index')
            ->with('success', 'Your message has been sent successfully. We will get back to you soon.');
    }
}
