<x-admin-layout>
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <div class="accent-line mb-3"></div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Tipe Kamar</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola jenis/tipe kamar rawat inap</p>
        </div>
        <a href="{{ route('admin.room-types.create') }}"
            class="btn-primary inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Tipe
        </a>
    </div>

    <div class="card overflow-hidden">
        {{-- Desktop Table --}}
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full table-clean">
                <thead>
                    <tr>
                        <th>Nama Tipe</th>
                        <th>Deskripsi</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Jumlah Kamar</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roomTypes as $type)
                        <tr>
                            <td class="font-medium text-gray-800">{{ $type->name }}</td>
                            <td class="text-gray-600">{{ $type->description ?? '-' }}</td>
                            <td class="text-gray-600">{{ $type->sort_order }}</td>
                            <td>
                                @if($type->is_active)
                                    <span
                                        class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-green-100 text-green-700">Aktif</span>
                                @else
                                    <span
                                        class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-gray-100 text-gray-500">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-gray-600">{{ \App\Models\Room::where('room_type', $type->name)->count() }} kamar
                            </td>
                            <td>
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.room-types.edit', $type->id) }}"
                                        class="p-2 rounded-lg text-gray-500 hover:bg-blue-50 hover:text-blue-600"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.room-types.destroy', $type->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus tipe kamar ini?')">
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
                            <td colspan="6" class="text-center py-8 text-gray-500">Belum ada tipe kamar</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile Cards --}}
        <div class="sm:hidden divide-y divide-gray-100">
            @forelse($roomTypes as $type)
                <div class="p-4">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $type->name }}</p>
                            <p class="text-xs text-gray-500">{{ $type->description ?? 'Tidak ada deskripsi' }}</p>
                        </div>
                        @if($type->is_active)
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-700">Aktif</span>
                        @else
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-500">Nonaktif</span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-500 mb-3">{{ \App\Models\Room::where('room_type', $type->name)->count() }}
                        kamar menggunakan tipe ini</p>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.room-types.edit', $type->id) }}"
                            class="flex-1 text-center py-2 text-xs font-medium text-blue-600 bg-blue-50 rounded-lg">Edit</a>
                        <form action="{{ route('admin.room-types.destroy', $type->id) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full py-2 text-xs font-medium text-red-600 bg-red-50 rounded-lg">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-500 text-sm">Belum ada tipe kamar</div>
            @endforelse
        </div>
    </div>
</x-admin-layout>