<x-admin-layout>
    <div class="max-w-3xl">
        <a href="{{ route('admin.rooms.index') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-green-600 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar Kamar
        </a>

        <div class="flex items-start justify-between mb-6">
            <div>
                <div class="accent-line mb-4"></div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $room->name }}</h1>
                <div class="flex items-center gap-3 mt-2">
                    <span
                        class="px-2.5 py-1 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg">{{ $room->room_type }}</span>
                    <span
                        class="px-2.5 py-1 rounded-lg text-sm font-semibold status-{{ $room->status }}">{{ ucfirst($room->status) }}</span>
                </div>
            </div>
            <a href="{{ route('admin.rooms.edit', $room->id) }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-600 rounded-lg font-medium hover:bg-gray-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
                Edit
            </a>
        </div>

        <div class="grid grid-cols-3 gap-6">
            <!-- Info -->
            <div class="col-span-2 card p-6">
                <h3 class="font-semibold text-gray-800 mb-5">Informasi Kamar</h3>

                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="text-center p-4 bg-gray-50 rounded-xl">
                        <div
                            class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"></path>
                            </svg>
                        </div>
                        <p class="text-xl font-bold text-gray-800">{{ $room->floor ?? '-' }}</p>
                        <p class="text-xs text-gray-500">Lantai</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-xl">
                        <div
                            class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5z"></path>
                            </svg>
                        </div>
                        <p class="text-xl font-bold text-gray-800">{{ $room->bed_count ?? 1 }}</p>
                        <p class="text-xs text-gray-500">Tempat Tidur</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-xl">
                        <div
                            class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-xl font-bold text-gray-800">24</p>
                        <p class="text-xs text-gray-500">Jam Layanan</p>
                    </div>
                </div>

                @if($room->facilities)
                    <div class="mb-6">
                        <p class="text-sm font-medium text-gray-700 mb-3">Fasilitas</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($room->facilitiesArray as $facility)
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 text-green-700 text-sm rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    {{ $facility }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($room->notes)
                    <div class="p-4 bg-blue-50 border border-blue-100 rounded-xl">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-blue-800">Catatan</p>
                                <p class="text-sm text-blue-700 mt-1">{{ $room->notes }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Audit -->
            <div class="card p-6">
                <div class="flex items-center justify-between mb-5">
                    <p class="font-semibold text-gray-800">Riwayat Status</p>
                </div>
                <div class="space-y-3 max-h-80 overflow-y-auto">
                    @forelse($room->audits as $audit)
                        <div class="flex items-start gap-3 pb-3 border-b border-gray-50 last:border-0">
                            <div
                                class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 {{ $audit->new_status === 'tersedia' ? 'bg-green-50' : ($audit->new_status === 'terisi' ? 'bg-red-50' : 'bg-yellow-50') }}">
                                <svg class="w-4 h-4 {{ $audit->new_status === 'tersedia' ? 'text-green-600' : ($audit->new_status === 'terisi' ? 'text-red-600' : 'text-yellow-600') }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-600">
                                    <span class="text-gray-400">{{ $audit->old_status ?? '-' }}</span>
                                    <span class="mx-1">→</span>
                                    <span class="font-medium text-gray-800">{{ ucfirst($audit->new_status) }}</span>
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $audit->user->name ?? 'Petugas' }} • {{ $audit->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-400 text-sm py-6">Belum ada riwayat</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>