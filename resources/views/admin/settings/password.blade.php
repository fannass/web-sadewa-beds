<x-admin-layout>
    {{-- Page Header --}}
    <div class="flex flex-col gap-4 mb-6">
        <div class="accent-line"></div>
        <div class="flex items-center gap-3">
            <div
                class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                    </path>
                </svg>
            </div>
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Ubah Password</h1>
                <p class="text-gray-500 text-sm">Kelola keamanan akun admin Anda</p>
            </div>
        </div>
    </div>

    {{-- Info Alert --}}
    <div class="card p-4 sm:p-5 mb-6 border-l-4 border-amber-500">
        <div class="flex items-start gap-3 sm:gap-4">
            <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg>
            </div>
            <div>
                <h4 class="text-gray-800 font-medium mb-1">Keamanan Akun</h4>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Gunakan password yang kuat dengan kombinasi huruf besar, huruf kecil, angka, dan simbol.
                    Minimal 8 karakter. Jangan gunakan password yang mudah ditebak.
                </p>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="card p-4 sm:p-6 max-w-xl">
        <form action="{{ route('admin.settings.password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                {{-- Current Password --}}
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password Saat Ini
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <input type="password" name="current_password" id="current_password"
                            class="w-full pl-12 pr-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-800 placeholder-gray-400 focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-colors @error('current_password') border-red-500 @enderror"
                            placeholder="Masukkan password saat ini">
                    </div>
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- New Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password Baru
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                </path>
                            </svg>
                        </div>
                        <input type="password" name="password" id="password"
                            class="w-full pl-12 pr-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-800 placeholder-gray-400 focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-colors @error('password') border-red-500 @enderror"
                            placeholder="Masukkan password baru (min. 8 karakter)">
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Password Baru
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full pl-12 pr-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-800 placeholder-gray-400 focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-colors"
                            placeholder="Ulangi password baru">
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end pt-4">
                    <button type="submit" class="btn-primary px-6 py-3 rounded-xl flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Ubah Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>