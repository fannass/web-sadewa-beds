<x-admin-layout>
    {{-- Page Header --}}
    <div class="flex flex-col gap-4 mb-6">
        <div class="accent-line"></div>
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Pengaturan Kontak</h1>
                <p class="text-gray-500 text-sm">Kelola informasi kontak WhatsApp resmi rumah sakit</p>
            </div>
        </div>
    </div>

    {{-- Info Alert --}}
    <div class="card p-4 sm:p-5 mb-6 border-l-4 border-blue-500">
        <div class="flex items-start gap-3 sm:gap-4">
            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-gray-800 font-medium mb-1">Informasi Penting</h4>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Fitur WhatsApp ini berfungsi sebagai <strong class="text-gray-800">jalur komunikasi</strong> antara pengunjung website dengan petugas RS. 
                    <span class="text-amber-600 font-medium">Ini bukan sistem booking atau reservasi kamar.</span> 
                    Pengunjung akan diarahkan ke WhatsApp resmi RS untuk konfirmasi atau pertanyaan lebih lanjut.
                </p>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="card p-4 sm:p-6">
        <form action="{{ route('admin.settings.contact.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                {{-- WhatsApp Number --}}
                <div>
                    <label for="whatsapp_number" class="block text-sm font-medium text-gray-700 mb-2">
                        Nomor WhatsApp Resmi RS
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-green-500" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="whatsapp_number" 
                            id="whatsapp_number"
                            value="{{ old('whatsapp_number', $whatsapp_number) }}"
                            class="w-full pl-12 pr-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-800 placeholder-gray-400 focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-colors @error('whatsapp_number') border-red-500 @enderror"
                            placeholder="6281234567890"
                        >
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Format internasional tanpa tanda + (contoh: 6281234567890)</p>
                    @error('whatsapp_number')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- WhatsApp Message --}}
                <div>
                    <label for="whatsapp_message" class="block text-sm font-medium text-gray-700 mb-2">
                        Pesan Default WhatsApp
                    </label>
                    <textarea 
                        name="whatsapp_message" 
                        id="whatsapp_message"
                        rows="4"
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-800 placeholder-gray-400 focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-colors resize-none @error('whatsapp_message') border-red-500 @enderror"
                        placeholder="Halo, saya ingin bertanya mengenai ketersediaan kamar..."
                    >{{ old('whatsapp_message', $whatsapp_message) }}</textarea>
                    <p class="mt-2 text-xs text-gray-500">Pesan ini akan otomatis terisi saat pengunjung menekan tombol WhatsApp</p>
                    @error('whatsapp_message')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Toggle Enable/Disable --}}
                <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-gray-800 font-medium">Aktifkan Tombol WhatsApp</h4>
                            <p class="text-gray-500 text-sm mt-1">Tampilkan tombol "Hubungi Petugas via WhatsApp" di halaman publik</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="is_whatsapp_enabled" 
                                value="1" 
                                class="sr-only peer"
                                {{ old('is_whatsapp_enabled', $is_whatsapp_enabled) ? 'checked' : '' }}
                            >
                            <div class="w-14 h-7 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-green-500"></div>
                        </label>
                    </div>
                </div>

                {{-- Preview Section --}}
                <div class="border-t border-gray-200 pt-6">
                    <h4 class="text-sm font-medium text-gray-700 mb-4">Preview Tombol WhatsApp</h4>
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <p class="text-xs text-gray-500 mb-3">Contoh tampilan tombol di website publik:</p>
                        <div class="flex flex-wrap gap-3">
                            {{-- Hero Style Button --}}
                            <span class="inline-flex items-center gap-2 px-5 py-3 bg-[#25D366]/10 border border-[#25D366]/30 text-[#25D366] rounded-xl text-sm font-medium">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                Hubungi Petugas via WhatsApp
                            </span>

                            {{-- Card Style Button --}}
                            <span class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#25D366]/10 border border-[#25D366]/30 text-[#25D366] rounded-lg text-sm font-medium">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                Tanya Ketersediaan
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end pt-4">
                    <button type="submit" class="btn-primary px-6 py-3 rounded-xl flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Pengaturan
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
