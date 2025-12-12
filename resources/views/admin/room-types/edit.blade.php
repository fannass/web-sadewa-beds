<x-admin-layout>
    {{-- Header --}}
    <div class="mb-6">
        <a href="{{ route('admin.room-types.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-green-600 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar Tipe Kamar
        </a>
        <div class="accent-line mb-3"></div>
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Edit Tipe Kamar</h1>
        <p class="text-sm text-gray-500 mt-1">Ubah data tipe kamar: {{ $roomType->name }}</p>
    </div>

    <div class="card p-5 sm:p-6 max-w-2xl">
        <form action="{{ route('admin.room-types.update', $roomType->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Tipe <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $roomType->name) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none text-sm"
                        placeholder="Contoh: VIP, Kelas 1, Reguler">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none text-sm resize-none"
                        placeholder="Deskripsi singkat tentang tipe kamar">{{ old('description', $roomType->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urutan Tampil</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $roomType->sort_order) }}" min="0"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none text-sm"
                        placeholder="0">
                    <p class="text-xs text-gray-400 mt-1">Urutan lebih kecil akan ditampilkan lebih dulu</p>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ $roomType->is_active ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-gray-300 text-green-600 focus:ring-green-500">
                    <label for="is_active" class="text-sm text-gray-700">Aktif (tampil di form kamar)</label>
                </div>

                @php
                    $roomsCount = \App\Models\Room::where('room_type', $roomType->name)->count();
                @endphp
                @if($roomsCount > 0)
                <div class="p-4 bg-blue-50 rounded-xl">
                    <div class="flex items-center gap-2 text-blue-700 text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Tipe ini digunakan oleh <strong>{{ $roomsCount }}</strong> kamar</span>
                    </div>
                </div>
                @endif
            </div>

            <div class="flex items-center gap-3 mt-8 pt-6 border-t border-gray-100">
                <button type="submit" class="btn-primary px-6 py-3 rounded-xl text-sm font-semibold">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.room-types.index') }}" class="px-6 py-3 text-sm font-medium text-gray-600 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
