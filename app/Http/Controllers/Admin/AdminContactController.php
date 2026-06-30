<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateContactInfoRequest;
use App\Models\ContactMessage;
use App\Services\ContactInfoService;
use App\Services\ContactMessageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function __construct(
        private ContactInfoService $contactInfoService,
        private ContactMessageService $messageService,
    ) {}

    public function index()
    {
        $contactInfo = $this->contactInfoService->getContactInfo();
        $messages = $this->messageService->getAllMessages();

        return view('admin.contact.index', compact('contactInfo', 'messages'));
    }

    public function update(UpdateContactInfoRequest $request): RedirectResponse
    {
        $this->contactInfoService->updateOrCreate($request->validated());

        return redirect()->route('admin.contact.index')
            ->with('success', 'Contact information updated successfully.');
    }

    public function showMessage(ContactMessage $message)
    {
        $this->messageService->markAsRead($message);

        return view('admin.contact.show', compact('message'));
    }

    public function markReplied(ContactMessage $message): RedirectResponse
    {
        $this->messageService->markAsReplied($message);

        return redirect()->route('admin.contact.index')
            ->with('success', 'Message marked as replied.');
    }

    public function destroyMessage(ContactMessage $message): RedirectResponse
    {
        $this->messageService->deleteMessage($message);

        return redirect()->route('admin.contact.index')
            ->with('success', 'Message deleted successfully.');
    }
}
