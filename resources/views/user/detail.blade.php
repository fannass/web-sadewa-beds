<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $room->name }} - RSKIA Sadewa</title>

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

        .card {
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 16px;
        }

        .info-card {
            background: #F8FAF9;
            border-radius: 12px;
            text-align: center;
            padding: 16px;
        }

        .info-icon {
            width: 48px;
            height: 48px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }

        .facility-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
            color: #047857;
            font-size: 12px;
            font-weight: 500;
            border-radius: 10px;
        }

        .room-card {
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 16px;
            transition: all 0.25s ease;
        }

        .room-card:hover {
            border-color: var(--primary);
            box-shadow: 0 8px 24px rgba(12, 161, 92, 0.12);
            transform: translateY(-3px);
        }
    </style>
</head>

<body class="antialiased">
    <x-navbar />
    <div class="h-[3px] bg-[#0CA15C]"></div>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 py-6 sm:py-10">
        <a href="{{ route('rooms') }}"
            class="inline-flex items-center gap-2 text-[12px] sm:text-[13px] text-gray-500 hover:text-[#0CA15C] transition-colors mb-6 sm:mb-8 group">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:-translate-x-1 transition-transform" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar Kamar
        </a>

        <div class="card overflow-hidden sm:rounded-[20px]">
            {{-- Header --}}
            <div class="p-5 sm:p-8 border-b border-gray-100 bg-gradient-to-r from-white to-[#FAFFFE]">
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                    <div>
                        <div class="accent-line mb-4 sm:mb-5"></div>
                        <h1 class="text-[22px] sm:text-[28px] font-bold text-gray-900 mb-2">{{ $room->name }}</h1>
                        <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                            <span
                                class="px-3 py-1 bg-gray-100 text-gray-600 text-[12px] sm:text-[13px] font-medium rounded-lg">{{ $room->room_type }}</span>
                            <span
                                class="px-3 py-1.5 rounded-lg text-[11px] sm:text-[12px] font-bold status-{{ $room->status }}">
                                {{ $room->status === 'tersedia' ? 'Tersedia' : ($room->status === 'terisi' ? 'Terisi' : 'Sedang Dibersihkan') }}
                            </span>
                        </div>
                        
                        @if($room->status === 'tersedia' && ($whatsapp['whatsapp_enabled'] ?? false))
                        <div class="mt-4 sm:mt-5">
                            <a href="{{ $whatsappRoomLink }}" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 px-5 py-2.5 text-[13px] sm:text-[14px] font-medium text-[#25D366] bg-[#25D366]/10 hover:bg-[#25D366]/20 border border-[#25D366]/30 rounded-xl transition-all">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                Konfirmasi ke Petugas
                            </a>
                        </div>
                        @endif
                    </div>
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl {{ $room->status === 'tersedia' ? 'bg-green-100' : ($room->status === 'terisi' ? 'bg-red-50' : 'bg-amber-50') }} flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 {{ $room->status === 'tersedia' ? 'text-[#0CA15C]' : ($room->status === 'terisi' ? 'text-red-500' : 'text-amber-500') }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>


            {{-- Info --}}
            <div class="p-5 sm:p-8">
                <div class="grid grid-cols-3 gap-3 sm:gap-5 mb-6 sm:mb-8">
                    <div class="info-card sm:p-6">
                        <div class="info-icon sm:w-14 sm:h-14 sm:rounded-xl sm:mb-4">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#0CA15C]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"></path>
                            </svg>
                        </div>
                        <p class="text-[20px] sm:text-[28px] font-bold text-gray-900">{{ $room->floor ?? '-' }}</p>
                        <p class="text-[11px] sm:text-[13px] text-gray-500 mt-1">Lantai</p>
                    </div>
                    <div class="info-card sm:p-6">
                        <div class="info-icon sm:w-14 sm:h-14 sm:rounded-xl sm:mb-4">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#0CA15C]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5z"></path>
                            </svg>
                        </div>
                        <p class="text-[20px] sm:text-[28px] font-bold text-gray-900">{{ $room->bed_count ?? 1 }}</p>
                        <p class="text-[11px] sm:text-[13px] text-gray-500 mt-1">Bed</p>
                    </div>
                    <div class="info-card sm:p-6">
                        <div class="info-icon sm:w-14 sm:h-14 sm:rounded-xl sm:mb-4">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#0CA15C]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-[20px] sm:text-[28px] font-bold text-gray-900">24</p>
                        <p class="text-[11px] sm:text-[13px] text-gray-500 mt-1">Jam</p>
                    </div>
                </div>

                @if($room->facilities)
                    <div class="mb-6 sm:mb-8">
                        <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                            <div class="accent-dot w-2 h-2 sm:w-[8px] sm:h-[8px]"></div>
                            <h3 class="font-bold text-gray-900 text-[14px] sm:text-[16px]">Fasilitas Kamar</h3>
                        </div>
                        <div class="flex flex-wrap gap-2 sm:gap-3">
                            @foreach($room->facilitiesArray as $facility)
                                <span class="facility-tag text-[11px] sm:text-[13px] py-2 sm:py-2.5 px-3 sm:px-4">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
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
                    <div class="p-4 sm:p-5 bg-blue-50 border border-blue-100 rounded-xl sm:rounded-2xl">
                        <div class="flex items-start gap-3 sm:gap-4">
                            <div
                                class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[13px] sm:text-[14px] font-semibold text-blue-800 mb-1">Catatan</p>
                                <p class="text-[12px] sm:text-[14px] text-blue-700 leading-relaxed">{{ $room->notes }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if($similarRooms->count() > 0)
            <div class="mt-8 sm:mt-12">
                <div class="flex items-center gap-2 sm:gap-3 mb-4 sm:mb-6">
                    <div class="accent-dot w-2 h-2 sm:w-[8px] sm:h-[8px]"></div>
                    <h3 class="text-[16px] sm:text-[18px] font-bold text-gray-900">Kamar Tersedia Lainnya</h3>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
                    @foreach($similarRooms as $similar)
                        <a href="{{ route('rooms.detail', $similar->id) }}" class="room-card p-4 sm:p-5 group">
                            <div class="flex items-center gap-3 mb-3 sm:mb-4">
                                <div
                                    class="w-10 h-10 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl bg-green-50 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#0CA15C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5z"></path>
                                    </svg>
                                </div>
                                <span
                                    class="px-2 sm:px-2.5 py-1 rounded-lg text-[10px] font-bold status-{{ $similar->status }}">{{ ucfirst($similar->status) }}</span>
                            </div>
                            <h4
                                class="font-bold text-gray-900 text-[14px] sm:text-[15px] group-hover:text-[#0CA15C] transition-colors">
                                {{ $similar->name }}</h4>
                            <p class="text-[12px] sm:text-[13px] text-gray-500 mt-1">{{ $similar->room_type }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </main>

    <footer class="bg-white border-t border-gray-100 mt-8 sm:mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-8 text-center">
            <p class="text-[12px] sm:text-[13px] text-gray-400">© {{ date('Y') }} RSKIA Sadewa</p>
        </div>
    </footer>
</body>

</html>