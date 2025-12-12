<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tentang Layanan Informasi Ketersediaan Kamar Rawat Inap RSKIA Sadewa">
    <title>Tentang Layanan - RSKIA Sadewa</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #0CA15C;
            --primary-dark: #0B6B40;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F5F7F9;
        }

        .accent-line {
            width: 48px;
            height: 4px;
            background-color: var(--primary);
            border-radius: 2px;
        }

        .accent-dot {
            width: 8px;
            height: 8px;
            background-color: var(--primary);
            border-radius: 50%;
        }

        .card {
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 16px;
        }

        .feature-card {
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .step-number {
            width: 36px;
            height: 36px;
            background: #0CA15C;
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
        }

        .info-card {
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
            border-radius: 16px;
            padding: 24px;
        }
    </style>
</head>

<body class="antialiased">
    <x-navbar />
    <div class="h-[3px] bg-[#0CA15C]"></div>

    {{-- HEADER --}}
    <section class="bg-white border-b border-gray-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 py-10 sm:py-16 text-center">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div class="accent-dot"></div>
                <span class="text-[11px] sm:text-[12px] font-semibold text-[#0CA15C] uppercase tracking-widest">Tentang
                    Layanan</span>
                <div class="accent-dot"></div>
            </div>
            <h1 class="text-[24px] sm:text-[32px] lg:text-[36px] font-bold text-gray-900 mb-4 leading-tight">Layanan
                Informasi Ketersediaan<br class="hidden sm:block">Kamar Rawat Inap</h1>
            <p class="text-gray-500 text-[14px] sm:text-[16px] max-w-2xl mx-auto leading-relaxed">
                Layanan berbasis web yang menyediakan informasi real-time tentang ketersediaan
                tempat tidur rawat inap di RSKIA Sadewa.
            </p>
        </div>
    </section>

    {{-- MAIN --}}
    <main class="max-w-5xl mx-auto px-4 sm:px-6 py-10 sm:py-16">
        {{-- Apa Itu --}}
        <div class="card p-6 sm:p-10 mb-8 sm:mb-10">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-10 items-center">
                <div>
                    <div class="accent-line mb-4 sm:mb-5"></div>
                    <h2 class="text-[20px] sm:text-[24px] font-bold text-gray-900 mb-4">Apa Itu Layanan Ini?</h2>
                    <p class="text-gray-500 text-[14px] sm:text-[15px] leading-relaxed mb-4">
                        Layanan Informasi Ketersediaan Kamar Rawat Inap adalah platform digital yang
                        dikembangkan oleh RSKIA Sadewa untuk memberikan transparansi informasi kepada
                        masyarakat tentang status ketersediaan tempat tidur.
                    </p>
                    <p class="text-gray-500 text-[14px] sm:text-[15px] leading-relaxed">
                        Dengan layanan ini, masyarakat dapat mengetahui jumlah kamar yang tersedia,
                        terisi, atau sedang dalam proses pembersihan secara real-time.
                    </p>
                </div>
                <div class="info-card">
                    <div class="flex items-center gap-3 sm:gap-4 mb-5 sm:mb-6">
                        <div
                            class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-white flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#0CA15C]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-[15px] sm:text-[17px]">RSKIA Sadewa</p>
                            <p class="text-[12px] sm:text-[13px] text-gray-600">Rumah Sakit Ibu & Anak</p>
                        </div>
                    </div>
                    <div class="space-y-2 sm:space-y-3">
                        <div class="flex items-center gap-2 sm:gap-3 text-[13px] sm:text-[14px] text-gray-700">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#0CA15C] flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Informasi akurat dari petugas RS
                        </div>
                        <div class="flex items-center gap-2 sm:gap-3 text-[13px] sm:text-[14px] text-gray-700">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#0CA15C] flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update real-time setiap perubahan
                        </div>
                        <div class="flex items-center gap-2 sm:gap-3 text-[13px] sm:text-[14px] text-gray-700">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#0CA15C] flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Dapat diakses 24 jam non-stop
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Keunggulan --}}
        <div class="mb-12 sm:mb-16">
            <div class="text-center mb-8 sm:mb-10">
                <div class="accent-line mx-auto mb-4"></div>
                <h2 class="text-[20px] sm:text-[24px] font-bold text-gray-900 mb-2">Keunggulan Layanan</h2>
                <p class="text-gray-500 text-[14px] sm:text-[15px]">Manfaat yang Anda dapatkan dari layanan ini</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <div class="feature-card p-6 sm:p-8">
                    <div class="feature-icon mb-5 sm:mb-6">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-[#0CA15C]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-[15px] sm:text-[17px] mb-3">Real-Time Update</h3>
                    <p class="text-[13px] sm:text-[14px] text-gray-500 leading-relaxed">
                        Status ketersediaan kamar diperbarui secara langsung oleh petugas rumah sakit.
                    </p>
                </div>

                <div class="feature-card p-6 sm:p-8">
                    <div class="feature-icon mb-5 sm:mb-6">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-[#0CA15C]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-[15px] sm:text-[17px] mb-3">Data Akurat</h3>
                    <p class="text-[13px] sm:text-[14px] text-gray-500 leading-relaxed">
                        Informasi berasal langsung dari sistem internal rumah sakit.
                    </p>
                </div>

                <div class="feature-card p-6 sm:p-8 sm:col-span-2 lg:col-span-1">
                    <div class="feature-icon mb-5 sm:mb-6">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-[#0CA15C]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-[15px] sm:text-[17px] mb-3">Akses 24 Jam</h3>
                    <p class="text-[13px] sm:text-[14px] text-gray-500 leading-relaxed">
                        Layanan dapat diakses kapan saja melalui browser tanpa instalasi.
                    </p>
                </div>
            </div>
        </div>

        {{-- Cara Menggunakan --}}
        <div class="card p-6 sm:p-10 mb-12 sm:mb-16">
            <div class="text-center mb-8 sm:mb-10">
                <div class="accent-line mx-auto mb-4"></div>
                <h2 class="text-[20px] sm:text-[24px] font-bold text-gray-900 mb-2">Cara Menggunakan Layanan</h2>
                <p class="text-gray-500 text-[14px] sm:text-[15px]">Langkah mudah untuk mengakses informasi</p>
            </div>

            <div class="grid sm:grid-cols-3 gap-6 sm:gap-8">
                <div class="text-center">
                    <div class="step-number mx-auto mb-4 sm:mb-5 sm:w-10 sm:h-10 sm:rounded-xl sm:text-base">1</div>
                    <h4 class="font-bold text-gray-900 text-[14px] sm:text-[16px] mb-2">Buka Halaman Ketersediaan</h4>
                    <p class="text-[13px] sm:text-[14px] text-gray-500">Klik menu "Ketersediaan Kamar" pada navigasi</p>
                </div>

                <div class="text-center">
                    <div class="step-number mx-auto mb-4 sm:mb-5 sm:w-10 sm:h-10 sm:rounded-xl sm:text-base">2</div>
                    <h4 class="font-bold text-gray-900 text-[14px] sm:text-[16px] mb-2">Filter Sesuai Kebutuhan</h4>
                    <p class="text-[13px] sm:text-[14px] text-gray-500">Gunakan filter status dan lantai untuk mencari
                    </p>
                </div>

                <div class="text-center">
                    <div class="step-number mx-auto mb-4 sm:mb-5 sm:w-10 sm:h-10 sm:rounded-xl sm:text-base">3</div>
                    <h4 class="font-bold text-gray-900 text-[14px] sm:text-[16px] mb-2">Lihat Detail Kamar</h4>
                    <p class="text-[13px] sm:text-[14px] text-gray-500">Klik pada kamar untuk melihat informasi lengkap
                    </p>
                </div>
            </div>
        </div>

        {{-- Status Kamar --}}
        <div class="mb-12 sm:mb-16">
            <div class="text-center mb-8 sm:mb-10">
                <div class="accent-line mx-auto mb-4"></div>
                <h2 class="text-[20px] sm:text-[24px] font-bold text-gray-900 mb-2">Arti Status Kamar</h2>
                <p class="text-gray-500 text-[14px] sm:text-[15px]">Penjelasan masing-masing status</p>
            </div>

            <div class="grid sm:grid-cols-3 gap-4 sm:gap-6">
                <div class="card p-5 sm:p-6 border-l-4 border-l-green-500">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-green-100 flex items-center justify-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span
                            class="px-2.5 sm:px-3 py-1 bg-green-100 text-green-700 text-[11px] sm:text-[12px] font-bold rounded-lg">TERSEDIA</span>
                    </div>
                    <p class="text-[13px] sm:text-[14px] text-gray-500">Kamar siap untuk digunakan oleh pasien baru.</p>
                </div>

                <div class="card p-5 sm:p-6 border-l-4 border-l-red-500">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-red-100 flex items-center justify-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <span
                            class="px-2.5 sm:px-3 py-1 bg-red-100 text-red-700 text-[11px] sm:text-[12px] font-bold rounded-lg">TERISI</span>
                    </div>
                    <p class="text-[13px] sm:text-[14px] text-gray-500">Kamar sedang digunakan oleh pasien.</p>
                </div>

                <div class="card p-5 sm:p-6 border-l-4 border-l-amber-500">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-amber-100 flex items-center justify-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-amber-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="px-2.5 sm:px-3 py-1 bg-amber-100 text-amber-700 text-[11px] sm:text-[12px] font-bold rounded-lg">DIBERSIHKAN</span>
                    </div>
                    <p class="text-[13px] sm:text-[14px] text-gray-500">Kamar dalam proses pembersihan.</p>
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="card p-8 sm:p-10 text-center bg-gradient-to-r from-[#0CA15C] to-[#0B6B40]">
            <h3 class="text-[20px] sm:text-[24px] font-bold text-white mb-3">Mulai Cek Ketersediaan Kamar</h3>
            <p class="text-white/80 text-[14px] sm:text-[15px] mb-6 max-w-lg mx-auto">
                Lihat status ketersediaan kamar rawat inap RSKIA Sadewa secara real-time sekarang
            </p>
            <a href="{{ route('rooms') }}"
                class="inline-flex items-center gap-2 sm:gap-3 px-6 sm:px-8 py-3 sm:py-4 bg-white text-[#0CA15C] rounded-xl font-semibold text-[14px] sm:text-[15px] hover:bg-gray-100 transition-colors">
                Lihat Ketersediaan Kamar
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                </svg>
            </a>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 mt-8 sm:mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-8 text-center">
            <p class="text-[12px] sm:text-[13px] text-gray-400">© {{ date('Y') }} RSKIA Sadewa. Layanan Informasi
                Ketersediaan Kamar Rawat Inap.</p>
        </div>
    </footer>
</body>

</html>