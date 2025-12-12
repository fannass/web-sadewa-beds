<x-admin-layout>
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <div class="accent-line mb-3"></div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Manajemen Kamar</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola data kamar rawat inap</p>
        </div>
        <a href="{{ route('admin.rooms.create') }}"
            class="btn-primary inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Kamar
        </a>
    </div>

    {{-- Mobile Cards / Desktop Table --}}
    <div class="card overflow-hidden">
        {{-- Desktop Table --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full table-clean">
                <thead>
                    <tr>
                        <th>Kamar</th>
                        <th>Tipe</th>
                        <th>Lantai</th>
                        <th>Bed</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-lg {{ $room->status === 'tersedia' ? 'bg-green-100' : ($room->status === 'terisi' ? 'bg-red-50' : 'bg-amber-50') }} flex items-center justify-center">
                                        <svg class="w-4 h-4 {{ $room->status === 'tersedia' ? 'text-green-600' : ($room->status === 'terisi' ? 'text-red-500' : 'text-amber-500') }}"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-800">{{ $room->name }}</span>
                                </div>
                            </td>
                            <td class="text-gray-600">{{ $room->room_type }}</td>
                            <td class="text-gray-600">{{ $room->floor ?? '-' }}</td>
                            <td class="text-gray-600">{{ $room->bed_count ?? 1 }}</td>
                            <td>
                                <div x-data="{ open: false, status: '{{ $room->status }}' }" class="relative">
                                    <button @click="open = !open"
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold status-{{ $room->status }} flex items-center gap-1">
                                        <span x-text="status.charAt(0).toUpperCase() + status.slice(1)"></span>
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false"
                                        class="absolute z-10 mt-1 w-36 bg-white border border-gray-200 rounded-lg shadow-lg py-1">
                                        @foreach(['tersedia', 'terisi', 'dibersihkan'] as $s)
                                            <button @click="
                                                fetch('{{ route('admin.rooms.updateStatus', $room->id) }}', {
                                                    method: 'PATCH',
                                                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                                    body: JSON.stringify({ status: '{{ $s }}' })
                                                }).then(() => { status = '{{ $s }}'; open = false; location.reload(); });
                                            "
                                                class="w-full text-left px-3 py-2 text-sm hover:bg-gray-50 flex items-center gap-2">
                                                <span
                                                    class="w-2 h-2 rounded-full {{ $s === 'tersedia' ? 'bg-green-500' : ($s === 'terisi' ? 'bg-red-500' : 'bg-amber-500') }}"></span>
                                                {{ ucfirst($s) }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.rooms.show', $room->id) }}"
                                        class="p-2 rounded-lg text-gray-500 hover:bg-gray-100" title="Lihat">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.rooms.edit', $room->id) }}"
                                        class="p-2 rounded-lg text-gray-500 hover:bg-blue-50 hover:text-blue-600"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus kamar ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-2 rounded-lg text-gray-500 hover:bg-red-50 hover:text-red-600"
                                            title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500">Belum ada data kamar</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile Cards --}}
        <div class="md:hidden divide-y divide-gray-100">
            @forelse($rooms as $room)
                <div class="p-4">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-lg {{ $room->status === 'tersedia' ? 'bg-green-100' : ($room->status === 'terisi' ? 'bg-red-50' : 'bg-amber-50') }} flex items-center justify-center">
                                <svg class="w-5 h-5 {{ $room->status === 'tersedia' ? 'text-green-600' : ($room->status === 'terisi' ? 'text-red-500' : 'text-amber-500') }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">{{ $room->name }}</p>
                                <p class="text-xs text-gray-500">{{ $room->room_type }}</p>
                            </div>
                        </div>
                        <span
                            class="px-2.5 py-1 rounded-lg text-[10px] font-bold status-{{ $room->status }}">{{ ucfirst($room->status) }}</span>
                    </div>
                    <div class="flex items-center gap-4 text-xs text-gray-500 mb-3">
                        <span>Lantai {{ $room->floor ?? '-' }}</span>
                        <span>{{ $room->bed_count ?? 1 }} Bed</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.rooms.show', $room->id) }}"
                            class="flex-1 text-center py-2 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg">Lihat</a>
                        <a href="{{ route('admin.rooms.edit', $room->id) }}"
                            class="flex-1 text-center py-2 text-xs font-medium text-blue-600 bg-blue-50 rounded-lg">Edit</a>
                        <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full py-2 text-xs font-medium text-red-600 bg-red-50 rounded-lg">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-500 text-sm">Belum ada data kamar</div>
            @endforelse
        </div>
    </div>

    @if($rooms->hasPages())
        <div class="mt-6">{{ $rooms->links() }}</div>
    @endif
</x-admin-layout>