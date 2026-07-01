@extends('layouts.admin')

@section('title', 'View Message')

@section('content')
<div class="mb-6 md:mb-8">
    <a href="{{ route('admin.contact.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium inline-flex items-center gap-1 mb-2">
        <i class="fas fa-arrow-left"></i> Back to Contact
    </a>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <h1 class="text-xl md:text-2xl font-bold text-gray-900">Message Details</h1>
        <span class="px-4 py-1.5 rounded-full text-sm font-medium {{ $message->status_badge }} self-start sm:self-auto">
            {{ ucfirst($message->status) }}
        </span>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
    {{-- Message Content --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
            <div class="mb-4 md:mb-6">
                <h2 class="text-lg md:text-xl font-semibold text-gray-900">{{ $message->subject }}</h2>
                <p class="text-xs text-gray-500 mt-1">Sent {{ $message->created_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
            <div class="prose max-w-none">
                <p class="text-gray-700 whitespace-pre-wrap text-sm">{{ $message->message }}</p>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-4 md:space-y-6">
        {{-- Sender Info --}}
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
            <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-3 md:mb-4">Sender Information</h3>
            <div class="space-y-3">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Name</label>
                    <p class="text-gray-900 font-medium text-sm">{{ $message->name }}</p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Email</label>
                    <p class="text-gray-900 text-sm">
                        <a href="mailto:{{ $message->email }}" class="text-primary-600 hover:text-primary-700">{{ $message->email }}</a>
                    </p>
                </div>
                @if($message->phone)
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Phone</label>
                        <p class="text-gray-900 text-sm">
                            <a href="tel:{{ $message->phone }}" class="text-primary-600 hover:text-primary-700">{{ $message->phone }}</a>
                        </p>
                    </div>
                @endif
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Date</label>
                    <p class="text-gray-900 text-sm">{{ $message->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
            <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-3">Actions</h3>
            <div class="grid grid-cols-2 gap-2">
                <a href="mailto:{{ $message->email }}" class="flex flex-col items-center gap-1.5 bg-blue-50 text-blue-700 px-3 py-3 rounded-lg font-medium hover:bg-blue-100 transition text-xs">
                    <i class="fas fa-reply"></i> Reply
                </a>
                @if($message->phone)
                    <a href="tel:{{ $message->phone }}" class="flex flex-col items-center gap-1.5 bg-green-50 text-green-700 px-3 py-3 rounded-lg font-medium hover:bg-green-100 transition text-xs">
                        <i class="fas fa-phone"></i> Call
                    </a>
                @endif
                @if($message->status !== 'replied')
                    <form action="{{ route('admin.contact.messages.replied', $message) }}" method="POST" class="col-span-2 sm:col-span-1">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full flex flex-col items-center gap-1.5 bg-emerald-50 text-emerald-700 px-3 py-3 rounded-lg font-medium hover:bg-emerald-100 transition text-xs">
                            <i class="fas fa-check"></i> Mark Replied
                        </button>
                    </form>
                @endif
                <form action="{{ route('admin.contact.messages.destroy', $message) }}" method="POST" onsubmit="event.preventDefault(); swalConfirm(this, 'Delete Message?', 'This action cannot be undone.')" class="{{ $message->status !== 'replied' ? 'col-span-2 sm:col-span-1' : 'col-span-2' }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full flex flex-col items-center gap-1.5 bg-red-50 text-red-700 px-3 py-3 rounded-lg font-medium hover:bg-red-100 transition text-xs">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
