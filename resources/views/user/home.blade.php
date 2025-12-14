<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Layanan Informasi Ketersediaan Tempat Tidur Rawat Inap RSKIA Sadewa">
    <title>RSKIA Sadewa - Informasi Ketersediaan Kamar Rawat Inap</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #0CA15C;
            --primary-dark: #0B6B40;
            --accent: #F2C94C;
            --bg: #F5F7F9;
            --bg-alt: #F0F4F3;
            --white: #FFFFFF;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg);
            color: #1F2937;
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

        .stat-card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
        }

        .stat-card.stat-total::before {
            background-color: #3B82F6;
        }

        .stat-card.stat-available::before {
            background-color: #0CA15C;
        }

        .stat-card.stat-occupied::before {
            background-color: #EF4444;
        }

        .stat-card.stat-cleaning::before {
            background-color: #F59E0B;
        }

        .status-tersedia {
            background-color: #ECFDF5;
            color: #047857;
            border: 1px solid #A7F3D0;
        }

        .status-terisi {
            background-color: #FEF2F2;
            color: #B91C1C;
            border: 1px solid #FECACA;
        }

        .status-dibersihkan {
            background-color: #FFFBEB;
            color: #B45309;
            border: 1px solid #FDE68A;
        }

        .room-card {
            background: var(--white);
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 16px;
            transition: all 0.25s ease;
        }

        .room-card:hover {
            border-color: var(--primary);
            box-shadow: 0 8px 24px rgba(12, 161, 92, 0.12);
            transform: translateY(-3px);
        }

        .room-card.available {
            background: linear-gradient(135deg, #FAFFFE 0%, #FFFFFF 100%);
            border-color: rgba(12, 161, 92, 0.15);
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 2px 8px rgba(12, 161, 92, 0.25);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .feature-card {
            background: var(--white);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 20px;
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

        .live-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: #ECFDF5;
            border: 1px solid #A7F3D0;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
            color: #047857;
        }

        .live-badge .dot {
            width: 6px;
            height: 6px;
            background: #10B981;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }
    </style>
</head>

<body class="antialiased">
    <x-navbar />
    <div class="h-[3px] bg-[#0CA15C]"></div>

    {{-- HERO SECTION --}}
    <section class="bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-16 lg:py-20">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                {{-- Left Content --}}
                <div class="lg:col-span-6 text-center lg:text-left">
                    <div class="mb-4 sm:mb-6 flex justify-center lg:justify-start">
                        <span class="live-badge">
                            <span class="dot"></span>
                            Real-Time Update
                        </span>
                    </div>

                    <div class="accent-line mb-4 sm:mb-6 mx-auto lg:mx-0"></div>

                    <h1
                        class="text-[28px] sm:text-[36px] lg:text-[44px] font-extrabold text-gray-900 leading-[1.15] tracking-tight mb-4 sm:mb-6">
                        Informasi Ketersediaan<br>
                        <span class="text-[#0CA15C]">Kamar Rawat Inap</span><br>
                        <span class="text-gray-700">RSKIA Sadewa</span>
                    </h1>

                    <p
                        class="text-[15px] sm:text-[17px] text-gray-500 leading-relaxed mb-6 sm:mb-8 max-w-lg mx-auto lg:mx-0">
                        Layanan informasi ketersediaan tempat tidur rawat inap yang diperbarui
                        secara real-time oleh petugas rumah sakit.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3 sm:gap-4">
                        <a href="{{ route('rooms') }}"
                            class="btn-primary w-full sm:w-auto inline-flex items-center justify-center gap-3 px-6 sm:px-7 py-3.5 sm:py-4 rounded-xl font-semibold text-[14px] sm:text-[15px]">
                            Lihat Ketersediaan Kamar
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        @if($whatsapp['whatsapp_enabled'] ?? false)
                        <a href="{{ $whatsapp['whatsapp_url'] }}" target="_blank" rel="noopener noreferrer"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3.5 sm:py-4 text-[14px] sm:text-[15px] font-medium text-[#25D366] hover:text-[#128C7E] bg-[#25D366]/10 hover:bg-[#25D366]/20 border border-[#25D366]/30 rounded-xl transition-all">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Hubungi Petugas via WhatsApp
                        </a>
                        @else
                        <a href="{{ route('about') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3.5 sm:py-4 text-[14px] sm:text-[15px] font-medium text-gray-600 hover:text-[#0CA15C] transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Pelajari Layanan
                        </a>
                        @endif
                    </div>
                </div>

                {{-- Right: Stats Panel --}}
                <div class="lg:col-span-6">
                    <div class="bg-[#F8FAF9] rounded-2xl sm:rounded-3xl p-5 sm:p-8 border border-gray-100">
                        <div class="flex items-center justify-between mb-4 sm:mb-6">
                            <div>
                                <h3 class="text-[14px] sm:text-[15px] font-semibold text-gray-800">Status Ketersediaan
                                </h3>
                                <p class="text-[11px] sm:text-[12px] text-gray-400 mt-0.5">Diperbarui:
                                    {{ now()->format('d M Y, H:i') }} WIB</p>
                            </div>
                            <div
                                class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-white shadow-sm flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#0CA15C]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 sm:gap-4">
                            <div class="stat-card stat-total p-4 sm:p-5">
                                <div
                                    class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 flex items-center justify-center mb-3 sm:mb-4">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-[24px] sm:text-[32px] font-bold text-gray-900 leading-none">
                                    {{ $stats['totalRooms'] }}</p>
                                <p class="text-[12px] sm:text-[13px] text-gray-500 mt-1 sm:mt-2">Total Kamar</p>
                            </div>

                            <div class="stat-card stat-available p-4 sm:p-5">
                                <div class="flex items-start justify-between mb-3 sm:mb-4">
                                    <div
                                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-green-50 flex items-center justify-center">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#0CA15C]" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="live-badge text-[9px] sm:text-[10px] px-2 py-1">
                                        <span class="dot" style="width:4px;height:4px;"></span>
                                        Live
                                    </span>
                                </div>
                                <p class="text-[24px] sm:text-[32px] font-bold text-[#0CA15C] leading-none">
                                    {{ $stats['tersedia'] }}</p>
                                <p class="text-[12px] sm:text-[13px] text-gray-500 mt-1 sm:mt-2">Tersedia</p>
                            </div>

                            <div class="stat-card stat-occupied p-4 sm:p-5">
                                <div
                                    class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-red-50 flex items-center justify-center mb-3 sm:mb-4">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-[24px] sm:text-[32px] font-bold text-red-500 leading-none">
                                    {{ $stats['terisi'] }}</p>
                                <p class="text-[12px] sm:text-[13px] text-gray-500 mt-1 sm:mt-2">Terisi</p>
                            </div>

                            <div class="stat-card stat-cleaning p-4 sm:p-5">
                                <div
                                    class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-amber-50 flex items-center justify-center mb-3 sm:mb-4">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-amber-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-[24px] sm:text-[32px] font-bold text-amber-500 leading-none">
                                    {{ \App\Models\Room::where('status', 'dibersihkan')->count() }}</p>
                                <p class="text-[12px] sm:text-[13px] text-gray-500 mt-1 sm:mt-2">Dibersihkan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ROOM LIST SECTION --}}
    @if($featuredRooms->count() > 0)
        <section class="py-12 sm:py-16 lg:py-20 bg-[#F5F7F9]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8 sm:mb-10">
                    <div class="text-center sm:text-left">
                        <div class="flex items-center justify-center sm:justify-start gap-3 mb-3">
                            <div class="accent-dot"></div>
                            <span
                                class="text-[11px] sm:text-[12px] font-semibold text-[#0CA15C] uppercase tracking-widest">Daftar
                                Kamar</span>
                        </div>
                        <h2 class="text-[22px] sm:text-[28px] font-bold text-gray-900">Kamar Tersedia Saat Ini</h2>
                        <p class="text-gray-500 text-[14px] sm:text-[15px] mt-2">Kamar dengan status tersedia untuk rawat
                            inap</p>
                    </div>
                    <a href="{{ route('rooms') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 text-[13px] sm:text-[14px] font-semibold text-[#0CA15C] bg-white border border-[#0CA15C]/20 rounded-xl hover:bg-[#0CA15C] hover:text-white transition-all">
                        Lihat Semua Kamar
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    @foreach($featuredRooms as $room)
                        <a href="{{ route('rooms.detail', $room->id) }}"
                            class="room-card {{ $room->status === 'tersedia' ? 'available' : '' }} p-5 sm:p-6 group">
                            <div class="flex items-start justify-between mb-4 sm:mb-5">
                                <div
                                    class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl {{ $room->status === 'tersedia' ? 'bg-green-100' : ($room->status === 'terisi' ? 'bg-red-50' : 'bg-amber-50') }} flex items-center justify-center">
                                    <svg class="w-6 h-6 sm:w-7 sm:h-7 {{ $room->status === 'tersedia' ? 'text-[#0CA15C]' : ($room->status === 'terisi' ? 'text-red-500' : 'text-amber-500') }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                                        </path>
                                    </svg>
                                </div>
                                <span
                                    class="px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-lg text-[10px] sm:text-[11px] font-bold status-{{ $room->status }}">
                                    {{ ucfirst($room->status) }}
                                </span>
                            </div>

                            <h3
                                class="font-bold text-gray-900 text-[15px] sm:text-[17px] mb-1 group-hover:text-[#0CA15C] transition-colors">
                                {{ $room->name }}</h3>
                            <p class="text-[13px] sm:text-[14px] text-gray-500 mb-4">{{ $room->room_type }}</p>

                            <div
                                class="flex items-center gap-4 sm:gap-5 text-[12px] sm:text-[13px] text-gray-400 pt-4 border-t border-gray-100">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"></path>
                                    </svg>
                                    Lantai {{ $room->floor ?? '-' }}
                                </span>
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5z"></path>
                                    </svg>
                                    {{ $room->bed_count ?? 1 }} Bed
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- FEATURES SECTION --}}
    <section id="tentang" class="py-12 sm:py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-10 sm:mb-14">
                <div class="flex items-center justify-center gap-3 mb-3">
                    <div class="accent-dot"></div>
                    <span
                        class="text-[11px] sm:text-[12px] font-semibold text-[#0CA15C] uppercase tracking-widest">Keunggulan</span>
                    <div class="accent-dot"></div>
                </div>
                <h2 class="text-[22px] sm:text-[28px] font-bold text-gray-900 mb-3">Mengapa Menggunakan Layanan Ini?
                </h2>
                <p class="text-gray-500 text-[14px] sm:text-[15px] max-w-xl mx-auto">Layanan informasi ketersediaan
                    kamar yang membantu masyarakat mendapatkan data akurat</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <div class="feature-card p-6 sm:p-8 text-center">
                    <div class="feature-icon mx-auto mb-5 sm:mb-6">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-[#0CA15C]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-[16px] sm:text-[18px] mb-3">Real-Time Update</h3>
                    <p class="text-[13px] sm:text-[14px] text-gray-500 leading-relaxed">Status ketersediaan kamar
                        diperbarui secara langsung oleh petugas rumah sakit</p>
                </div>

                <div class="feature-card p-6 sm:p-8 text-center">
                    <div class="feature-icon mx-auto mb-5 sm:mb-6">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-[#0CA15C]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-[16px] sm:text-[18px] mb-3">Akurat dari Petugas</h3>
                    <p class="text-[13px] sm:text-[14px] text-gray-500 leading-relaxed">Data langsung dari sistem
                        internal rumah sakit yang dikelola oleh petugas bersertifikat</p>
                </div>

                <div class="feature-card p-6 sm:p-8 text-center sm:col-span-2 lg:col-span-1">
                    <div class="feature-icon mx-auto mb-5 sm:mb-6">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-[#0CA15C]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-[16px] sm:text-[18px] mb-3">Akses 24 Jam</h3>
                    <p class="text-[13px] sm:text-[14px] text-gray-500 leading-relaxed">Layanan dapat diakses kapan saja
                        dan di mana saja melalui browser</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-[#1A1F2E] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-16">
            <div class="grid sm:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-10">
                <div class="sm:col-span-2 lg:col-span-5">
                    <div class="flex items-center gap-3 mb-4 sm:mb-6">
                        <img src="{{ asset('assets/logo.png') }}" alt="Logo"
                            class="h-10 sm:h-12 w-auto brightness-0 invert">
                        <div>
                            <p class="font-bold text-white text-[15px] sm:text-[17px]">RSKIA Sadewa</p>
                            <p class="text-[12px] sm:text-[13px] text-gray-400">Rumah Sakit Ibu & Anak</p>
                        </div>
                    </div>
                    <p class="text-[13px] sm:text-[14px] text-gray-400 leading-relaxed max-w-sm mb-6">
                        Layanan Informasi Ketersediaan Kamar Rawat Inap untuk memudahkan masyarakat
                        merencanakan kunjungan dengan informasi real-time.
                    </p>
                    <div class="flex items-center gap-2">
                        <span class="live-badge bg-green-900/30 border-green-700/50 text-green-400">
                            <span class="dot bg-green-400"></span>
                            Layanan Aktif
                        </span>
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <h4 class="font-bold text-white text-[13px] sm:text-[14px] mb-4 sm:mb-5 uppercase tracking-wider">
                        Navigasi</h4>
                    <ul class="space-y-2 sm:space-y-3 text-[13px] sm:text-[14px] text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-[#0CA15C] transition-colors">Beranda</a>
                        </li>
                        <li><a href="{{ route('rooms') }}" class="hover:text-[#0CA15C] transition-colors">Ketersediaan
                                Kamar</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-[#0CA15C] transition-colors">Tentang
                                Layanan</a></li>
                    </ul>
                </div>

                <div class="lg:col-span-4">
                    <h4 class="font-bold text-white text-[13px] sm:text-[14px] mb-4 sm:mb-5 uppercase tracking-wider">
                        Kontak</h4>
                    <ul class="space-y-3 sm:space-y-4 text-[13px] sm:text-[14px] text-gray-400">
                        <li class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <span>Jl. Raya Sadewa No. 123<br>Yogyakarta, Indonesia</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <span>(0274) 123-4567</span>
                        </li>
                        @if($whatsapp['whatsapp_enabled'] ?? false)
                        <li class="flex items-center gap-3">
                            <a href="{{ $whatsapp['whatsapp_url'] }}" target="_blank" rel="noopener noreferrer"
                                class="flex items-center gap-3 text-gray-400 hover:text-[#25D366] transition-colors group">
                                <div class="w-8 h-8 rounded-lg bg-white/5 group-hover:bg-[#25D366]/20 flex items-center justify-center flex-shrink-0 transition-colors">
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-[#25D366] transition-colors" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                </div>
                                <span>Hubungi via WhatsApp</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/10 mt-10 sm:mt-12 pt-6 sm:pt-8">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-[12px] sm:text-[13px] text-gray-500 text-center sm:text-left">© {{ date('Y') }} RSKIA
                        Sadewa. Layanan Informasi Ketersediaan Kamar Rawat Inap.</p>
                    <div class="flex items-center gap-2 text-[11px] sm:text-[12px] text-gray-500">
                        <span class="w-2 h-2 rounded-full bg-[#0CA15C]"></span>
                        v1.0.0
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>