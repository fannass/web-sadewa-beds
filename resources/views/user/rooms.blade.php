<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Daftar ketersediaan kamar rawat inap RSKIA Sadewa">
    <title>Ketersediaan Kamar - RSKIA Sadewa</title>

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

        .stat-card {
            background: white;
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

        .stat-card.stat-available::before {
            background-color: #0CA15C;
        }

        .stat-card.stat-occupied::before {
            background-color: #EF4444;
        }

        .stat-card.stat-cleaning::before {
            background-color: #F59E0B;
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

        .room-card.available {
            background: linear-gradient(135deg, #FAFFFE 0%, #FFFFFF 100%);
            border-color: rgba(12, 161, 92, 0.15);
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

        .btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 2px 8px rgba(12, 161, 92, 0.25);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
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

    {{-- HEADER --}}
    <section class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-10">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div class="text-center sm:text-left">
                    <div class="flex items-center justify-center sm:justify-start gap-3 mb-3">
                        <div class="accent-dot"></div>
                        <span
                            class="text-[11px] sm:text-[12px] font-semibold text-[#0CA15C] uppercase tracking-widest">Status
                            Real-Time</span>
                    </div>
                    <h1 class="text-[22px] sm:text-[28px] font-bold text-gray-900 mb-2">Ketersediaan Kamar Rawat Inap
                    </h1>
                    <p class="text-gray-500 text-[13px] sm:text-[15px]">Status kamar diperbarui secara real-time oleh
                        petugas</p>
                </div>
                <span class="live-badge mx-auto sm:mx-0">
                    <span class="dot"></span>
                    Live Update
                </span>
            </div>
        </div>
    </section>

    {{-- STATS BAR --}}
    <section class="bg-[#F8FAF9] border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 sm:py-6">
            <div class="grid grid-cols-3 gap-3 sm:gap-6">
                <div class="stat-card stat-available p-3 sm:p-5 flex items-center gap-3 sm:gap-4">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#0CA15C]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[20px] sm:text-[28px] font-bold text-[#0CA15C] leading-none">
                            {{ \App\Models\Room::where('status', 'tersedia')->count() }}</p>
                        <p class="text-[11px] sm:text-[13px] text-gray-500 mt-1">Tersedia</p>
                    </div>
                </div>

                <div class="stat-card stat-occupied p-3 sm:p-5 flex items-center gap-3 sm:gap-4">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-red-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[20px] sm:text-[28px] font-bold text-red-500 leading-none">
                            {{ \App\Models\Room::where('status', 'terisi')->count() }}</p>
                        <p class="text-[11px] sm:text-[13px] text-gray-500 mt-1">Terisi</p>
                    </div>
                </div>

                <div class="stat-card stat-cleaning p-3 sm:p-5 flex items-center gap-3 sm:gap-4">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-amber-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[20px] sm:text-[28px] font-bold text-amber-500 leading-none">
                            {{ \App\Models\Room::where('status', 'dibersihkan')->count() }}</p>
                        <p class="text-[11px] sm:text-[13px] text-gray-500 mt-1 hidden sm:block">Dibersihkan</p>
                        <p class="text-[11px] text-gray-500 mt-1 sm:hidden">Proses</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MAIN --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-10">
        {{-- Filter --}}
        <div class="bg-white border border-gray-200 rounded-xl sm:rounded-2xl p-4 sm:p-5 mb-6 sm:mb-8">
            <form method="GET" class="space-y-4 sm:space-y-0 sm:flex sm:flex-wrap sm:items-end sm:gap-4">
                <div class="flex-1 min-w-0 sm:min-w-[180px]">
                    <label
                        class="text-[10px] sm:text-[11px] font-semibold text-gray-400 uppercase tracking-wide mb-1.5 block">Status</label>
                    <select name="status"
                        class="w-full px-3 sm:px-4 py-2.5 sm:py-3 text-[13px] sm:text-[14px] rounded-lg sm:rounded-xl border border-gray-200 bg-white focus:border-green-500 outline-none">
                        <option value="">Semua Status</option>
                        <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia
                        </option>
                        <option value="terisi" {{ request('status') === 'terisi' ? 'selected' : '' }}>Terisi</option>
                        <option value="dibersihkan" {{ request('status') === 'dibersihkan' ? 'selected' : '' }}>
                            Dibersihkan</option>
                    </select>
                </div>
                <div class="flex-1 sm:flex-none">
                    <label
                        class="text-[10px] sm:text-[11px] font-semibold text-gray-400 uppercase tracking-wide mb-1.5 block">Lantai</label>
                    <select name="floor"
                        class="w-full px-3 sm:px-4 py-2.5 sm:py-3 text-[13px] sm:text-[14px] rounded-lg sm:rounded-xl border border-gray-200 bg-white focus:border-green-500 outline-none sm:min-w-[140px]">
                        <option value="">Semua Lantai</option>
                        @foreach($floors as $floor)
                            <option value="{{ $floor }}" {{ request('floor') == $floor ? 'selected' : '' }}>Lantai
                                {{ $floor }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2 sm:gap-3">
                    <button type="submit"
                        class="flex-1 sm:flex-none btn-primary px-5 sm:px-6 py-2.5 sm:py-3 text-[13px] sm:text-[14px] font-semibold rounded-lg sm:rounded-xl">Filter</button>
                    <a href="{{ route('rooms') }}"
                        class="flex-1 sm:flex-none px-5 sm:px-6 py-2.5 sm:py-3 text-[13px] sm:text-[14px] font-medium text-gray-600 bg-gray-100 rounded-lg sm:rounded-xl hover:bg-gray-200 text-center">Reset</a>
                </div>
            </form>
        </div>

        {{-- Room Grid --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @forelse($rooms as $room)
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
                        class="flex items-center gap-4 sm:gap-5 text-[11px] sm:text-[13px] text-gray-400 pt-4 border-t border-gray-100">
                        <span class="flex items-center gap-1.5 sm:gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"></path>
                            </svg>
                            Lantai {{ $room->floor ?? '-' }}
                        </span>
                        <span class="flex items-center gap-1.5 sm:gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5z"></path>
                            </svg>
                            {{ $room->bed_count ?? 1 }} Bed
                        </span>
                    </div>
                </a>
            @empty
                <div
                    class="col-span-full bg-white border border-gray-200 rounded-xl sm:rounded-2xl p-10 sm:p-16 text-center">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-gray-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-[14px] sm:text-[15px] font-medium">Tidak ada kamar yang ditemukan</p>
                    <p class="text-gray-400 text-[12px] sm:text-[13px] mt-1">Coba ubah filter pencarian Anda</p>
                </div>
            @endforelse
        </div>

        @if($rooms->hasPages())
            <div class="mt-8 sm:mt-10">{{ $rooms->links() }}</div>
        @endif
    </main>

    <footer class="bg-white border-t border-gray-100 mt-8 sm:mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-8 text-center">
            <p class="text-[12px] sm:text-[13px] text-gray-400">© {{ date('Y') }} RSKIA Sadewa. Layanan Informasi
                Ketersediaan Kamar Rawat Inap.</p>
        </div>
    </footer>
</body>

</html>