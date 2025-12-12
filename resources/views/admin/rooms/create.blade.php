<x-admin-layout>
    <div class="max-w-xl">
        <a href="{{ route('admin.rooms.index') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-green-600 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar Kamar
        </a>

        <div class="accent-line mb-4"></div>
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Kamar Baru</h1>

        <div class="card p-6">
            <form action="{{ route('admin.rooms.store') }}" method="POST">
                @csrf

                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kamar *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none"
                            placeholder="Contoh: Kamar Melati 101">
                        @error('name')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="room_type" class="block text-sm font-medium text-gray-700 mb-2">Tipe Kamar
                                *</label>
                            <select name="room_type" id="room_type" required
                                class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-white focus:border-green-500 outline-none">
                                @foreach(\App\Models\RoomType::where('is_active', true)->orderBy('sort_order')->get() as $type)
                                    <option value="{{ $type->name }}" {{ old('room_type') == $type->name ? 'selected' : '' }}>
                                        {{ $type->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-400 mt-1">
                                <a href="{{ route('admin.room-types.index') }}"
                                    class="text-green-600 hover:underline">Kelola tipe kamar</a>
                            </p>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <select name="status" id="status" required
                                class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-white focus:border-green-500 outline-none">
                                <option value="tersedia">Tersedia</option>
                                <option value="terisi">Terisi</option>
                                <option value="dibersihkan">Dibersihkan</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="floor" class="block text-sm font-medium text-gray-700 mb-2">Lantai</label>
                            <input type="number" name="floor" id="floor" value="{{ old('floor') }}" min="1" max="10"
                                class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none"
                                placeholder="1">
                        </div>

                        <div>
                            <label for="bed_count" class="block text-sm font-medium text-gray-700 mb-2">Jumlah
                                Bed</label>
                            <input type="number" name="bed_count" id="bed_count" value="{{ old('bed_count', 1) }}"
                                min="1" max="10"
                                class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none">
                        </div>
                    </div>

                    <div>
                        <label for="facilities" class="block text-sm font-medium text-gray-700 mb-2">Fasilitas</label>
                        <input type="text" name="facilities" id="facilities" value="{{ old('facilities') }}"
                            class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none"
                            placeholder="AC, TV, Kamar Mandi Dalam (pisahkan dengan koma)">
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                        <textarea name="notes" id="notes" rows="3"
                            class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none resize-none"
                            placeholder="Catatan tambahan...">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-8 pt-6 border-t border-gray-100">
                    <button type="submit" class="btn-primary px-6 py-3 rounded-xl font-medium">
                        Simpan Kamar
                    </button>
                    <a href="{{ route('admin.rooms.index') }}"
                        class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-medium hover:bg-gray-200">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>