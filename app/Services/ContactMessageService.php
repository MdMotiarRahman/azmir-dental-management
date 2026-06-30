<?php

namespace App\Services;

use App\Models\ContactMessage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactMessageService
{
    public function getAllMessages(?string $search = null, ?string $status = null): LengthAwarePaginator
    {
        $query = ContactMessage::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        return $query->latest()->paginate(15);
    }

    public function getMessageById(int $id): ContactMessage
    {
        return ContactMessage::findOrFail($id);
    }

    public function markAsRead(ContactMessage $message): ContactMessage
    {
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return $message->fresh();
    }

    public function markAsReplied(ContactMessage $message): ContactMessage
    {
        $message->update(['status' => 'replied']);

        return $message->fresh();
    }

    public function deleteMessage(ContactMessage $message): bool
    {
        return $message->delete();
    }

    public function getUnreadCount(): int
    {
        return ContactMessage::where('status', 'unread')->count();
    }

    public function getTotalCount(): int
    {
        return ContactMessage::count();
    }
}
