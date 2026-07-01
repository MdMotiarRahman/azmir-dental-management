@extends('layouts.admin')

@section('title', 'Contact Information')

@section('content')
<div class="mb-6 md:mb-8">
    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Contact Information</h1>
    <p class="text-gray-600 text-sm">Manage your clinic's contact details and messages</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
    {{-- Contact Info Form --}}
    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
        <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-4 md:mb-6">Clinic Details</h2>
        <form action="{{ route('admin.contact.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1.5">Phone Number</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $contactInfo->phone ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('phone') border-red-500 @enderror"
                        placeholder="e.g. 01638209228">
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $contactInfo->email ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('email') border-red-500 @enderror"
                        placeholder="e.g. info@azmeerdental.com">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1.5">Address</label>
                    <textarea name="address" id="address" rows="2"
                        class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('address') border-red-500 @enderror"
                        placeholder="e.g. Patgram Road, Jamalpur">{{ old('address', $contactInfo->address ?? '') }}</textarea>
                    @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-1.5">WhatsApp Number</label>
                    <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $contactInfo->whatsapp ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('whatsapp') border-red-500 @enderror"
                        placeholder="e.g. 01638209228">
                    @error('whatsapp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="facebook" class="block text-sm font-medium text-gray-700 mb-1.5">Facebook URL</label>
                    <input type="url" name="facebook" id="facebook" value="{{ old('facebook', $contactInfo->facebook ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('facebook') border-red-500 @enderror"
                        placeholder="e.g. https://facebook.com/azmeerdental">
                    @error('facebook') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="google_map_embed" class="block text-sm font-medium text-gray-700 mb-1.5">Google Map Embed Code</label>
                    <textarea name="google_map_embed" id="google_map_embed" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-3 md:px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('google_map_embed') border-red-500 @enderror"
                        placeholder="Paste your Google Maps embed code here...">{{ old('google_map_embed', $contactInfo->google_map_embed ?? '') }}</textarea>
                    @error('google_map_embed') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="mt-5">
                <button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-primary-700 transition text-sm">
                    Update Contact Information
                </button>
            </div>
        </form>
    </div>

    {{-- Preview --}}
    <div class="space-y-4 md:space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
            <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Preview</h2>
            <div class="space-y-3">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-phone text-primary-600 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Phone</p>
                        <p class="text-gray-900 font-medium text-sm">{{ $contactInfo->phone ?? '-' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-envelope text-primary-600 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Email</p>
                        <p class="text-gray-900 font-medium text-sm">{{ $contactInfo->email ?? '-' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-map-marker-alt text-primary-600 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Address</p>
                        <p class="text-gray-900 font-medium text-sm">{{ $contactInfo->address ?? '-' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fab fa-whatsapp text-primary-600 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">WhatsApp</p>
                        <p class="text-gray-900 font-medium text-sm">{{ $contactInfo->whatsapp ?? '-' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fab fa-facebook text-primary-600 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Facebook</p>
                        <p class="text-gray-900 font-medium text-sm">{{ $contactInfo->facebook ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($contactInfo->google_map_embed ?? null)
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
                <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Map Preview</h2>
                <div class="rounded-lg overflow-hidden border border-gray-200">
                    {!! $contactInfo->google_map_embed !!}
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Contact Messages --}}
<div class="mt-6 md:mt-8">
    <div class="flex items-center justify-between mb-4 md:mb-6">
        <h2 class="text-lg md:text-xl font-bold text-gray-900">Contact Messages</h2>
    </div>

    {{-- Desktop Table --}}
    <div class="hidden md:block bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">From</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($messages as $message)
                        <tr class="hover:bg-gray-50 {{ $message->status === 'unread' ? 'bg-blue-50/50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $message->name }}</div>
                                <div class="text-sm text-gray-500">{{ $message->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $message->subject }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate">{{ Str::limit($message->message, 60) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $message->status_badge }}">{{ ucfirst($message->status) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $message->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.contact.messages.show', $message) }}" class="text-blue-600 hover:text-blue-800" title="View"><i class="fas fa-eye"></i></a>
                                    @if($message->status !== 'replied')
                                        <form action="{{ route('admin.contact.messages.replied', $message) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-600 hover:text-green-800" title="Mark as Replied"><i class="fas fa-check"></i></button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.contact.messages.destroy', $message) }}" method="POST" class="inline" onsubmit="event.preventDefault(); swalConfirm(this, 'Delete Message?', 'This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">No contact messages yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $messages->links() }}</div>
    </div>

    {{-- Mobile Cards --}}
    <div class="md:hidden space-y-3">
        @forelse($messages as $message)
            <a href="{{ route('admin.contact.messages.show', $message) }}" class="block bg-white rounded-xl shadow-sm p-4 hover:bg-gray-50 transition {{ $message->status === 'unread' ? 'border-l-4 border-blue-500' : '' }}">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $message->name }}</p>
                        <p class="text-xs text-gray-500">{{ $message->subject }}</p>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[11px] font-medium {{ $message->status_badge }}">{{ ucfirst($message->status) }}</span>
                </div>
                <p class="text-xs text-gray-500 line-clamp-2 mb-2">{{ Str::limit($message->message, 100) }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-400">{{ $message->created_at->format('M d, Y') }}</span>
                    <div class="flex items-center gap-2">
                        @if($message->status !== 'replied')
                            <form action="{{ route('admin.contact.messages.replied', $message) }}" method="POST" onclick="event.stopPropagation(); event.preventDefault(); this.submit();">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-green-600 text-xs font-medium"><i class="fas fa-check"></i></button>
                            </form>
                        @endif
                        <form action="{{ route('admin.contact.messages.destroy', $message) }}" method="POST" onclick="event.stopPropagation(); event.preventDefault(); swalConfirm(this, 'Delete?', 'This message will be permanently deleted.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-xs font-medium"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </a>
        @empty
            <div class="bg-white rounded-xl shadow-sm p-8 text-center text-gray-500 text-sm">No contact messages yet.</div>
        @endforelse
        <div class="mt-4">{{ $messages->links() }}</div>
    </div>
</div>
@endsection
