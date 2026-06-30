@extends('layouts.admin')

@section('title', 'View Message')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.contact.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium inline-flex items-center gap-1 mb-2">
        <i class="fas fa-arrow-left"></i> Back to Contact
    </a>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Message Details</h1>
        <span class="px-4 py-2 rounded-full text-sm font-medium {{ $message->status_badge }}">
            {{ ucfirst($message->status) }}
        </span>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Message Content --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">{{ $message->subject }}</h2>
                    <p class="text-sm text-gray-500 mt-1">Sent {{ $message->created_at->format('M d, Y \a\t h:i A') }}</p>
                </div>
            </div>

            <div class="prose max-w-none">
                <p class="text-gray-700 whitespace-pre-wrap">{{ $message->message }}</p>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-6">
        {{-- Sender Info --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Sender Information</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Name</label>
                    <p class="text-gray-900 font-medium">{{ $message->name }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Email</label>
                    <p class="text-gray-900">
                        <a href="mailto:{{ $message->email }}" class="text-primary-600 hover:text-primary-700">{{ $message->email }}</a>
                    </p>
                </div>
                @if($message->phone)
                    <div>
                        <label class="block text-sm text-gray-500 mb-1">Phone</label>
                        <p class="text-gray-900">
                            <a href="tel:{{ $message->phone }}" class="text-primary-600 hover:text-primary-700">{{ $message->phone }}</a>
                        </p>
                    </div>
                @endif
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Date</label>
                    <p class="text-gray-900">{{ $message->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
            <div class="space-y-3">
                <a href="mailto:{{ $message->email }}" class="w-full flex items-center justify-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition">
                    <i class="fas fa-reply"></i> Reply via Email
                </a>
                @if($message->phone)
                    <a href="tel:{{ $message->phone }}" class="w-full flex items-center justify-center gap-2 bg-green-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-green-700 transition">
                        <i class="fas fa-phone"></i> Call
                    </a>
                @endif
                @if($message->status !== 'replied')
                    <form action="{{ route('admin.contact.messages.replied', $message) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-emerald-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-emerald-700 transition">
                            <i class="fas fa-check"></i> Mark as Replied
                        </button>
                    </form>
                @endif
                <form action="{{ route('admin.contact.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-100 text-red-700 px-4 py-2.5 rounded-lg font-medium hover:bg-red-200 transition">
                        <i class="fas fa-trash"></i> Delete Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
