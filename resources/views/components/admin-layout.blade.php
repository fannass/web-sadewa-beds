@props([])

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - RSKIA Sadewa</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        .sidebar {
            background-color: #FFFFFF;
            border-right: 1px solid #E5E7EB;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #6B7280;
            transition: all 0.15s ease;
            position: relative;
        }

        .nav-item:hover {
            color: var(--primary);
            background-color: #F0FDF4;
        }

        .nav-item.active {
            color: var(--primary);
            background-color: #F0FDF4;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background-color: var(--primary);
            border-radius: 0 3px 3px 0;
        }

        .accent-line {
            width: 48px;
            height: 4px;
            background-color: var(--primary);
            border-radius: 2px;
        }

        .card {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 12px;
        }

        .stat-card {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .status-tersedia {
            background-color: #ECFDF5;
            color: #047857;
        }

        .status-terisi {
            background-color: #FEF2F2;
            color: #B91C1C;
        }

        .status-dibersihkan {
            background-color: #FFFBEB;
            color: #B45309;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .table-clean th {
            background-color: #F9FAFB;
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #6B7280;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            border-bottom: 1px solid #E5E7EB;
        }

        .table-clean td {
            padding: 14px 16px;
            border-bottom: 1px solid #F3F4F6;
            font-size: 14px;
            color: #374151;
        }

        .table-clean tr:hover td {
            background-color: #FAFAFA;
        }

        /* Mobile sidebar overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 40;
        }

        .sidebar-overlay.active {
            display: block;
        }

        @media (max-width: 1023px) {
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                height: 100%;
                z-index: 50;
                transition: left 0.3s ease;
            }

            .sidebar.open {
                left: 0;
            }

            .main-content {
                margin-left: 0 !important;
            }
        }
    </style>
</head>

<body class="antialiased">
    <div class="flex min-h-screen">
        {{-- Mobile Overlay --}}
        <div id="sidebar-overlay" class="sidebar-overlay lg:hidden" onclick="toggleSidebar()"></div>

        {{-- Sidebar --}}
        <aside id="sidebar" class="sidebar w-60 lg:fixed h-full flex flex-col">
            <div class="p-4 sm:p-5 border-b border-gray-100">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 sm:gap-3">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-8 sm:h-9 w-auto"
                        onerror="this.parentElement.innerHTML='<div class=\'w-8 h-8 sm:w-9 sm:h-9 rounded-lg bg-green-600 flex items-center justify-center text-white font-bold text-xs\'>RS</div>'">
                    <div>
                        <p class="font-semibold text-gray-800 text-[13px] sm:text-sm leading-tight">RSKIA Sadewa</p>
                        <p class="text-[10px] sm:text-xs text-gray-400">Admin Panel</p>
                    </div>
                </a>
            </div>

            <nav class="flex-1 p-3 sm:p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.rooms.index') }}"
                    class="nav-item {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                    Manajemen Kamar
                </a>

                <a href="{{ route('admin.room-types.index') }}"
                    class="nav-item {{ request()->routeIs('admin.room-types.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                        </path>
                    </svg>
                    Tipe Kamar
                </a>

                <a href="{{ route('admin.audits') }}"
                    class="nav-item {{ request()->routeIs('admin.audits') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                    Audit Log
                </a>

                <a href="{{ route('admin.analytics') }}"
                    class="nav-item {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    Analytics
                </a>

                <a href="{{ route('admin.settings.contact') }}"
                    class="nav-item {{ request()->routeIs('admin.settings.contact') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    Pengaturan Kontak
                </a>

                <a href="{{ route('admin.settings.password') }}"
                    class="nav-item {{ request()->routeIs('admin.settings.password') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                        </path>
                    </svg>
                    Ubah Password
                </a>

                <div class="border-t border-gray-100 my-3"></div>

                <a href="{{ route('home') }}"
                    class="nav-item text-blue-600 hover:text-blue-700 hover:bg-blue-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                        </path>
                    </svg>
                    Lihat Website
                </a>
            </nav>

            <div class="p-3 sm:p-4 border-t border-gray-100">
                <div class="flex items-center gap-2 sm:gap-3 mb-3">
                    <div
                        class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg bg-green-100 flex items-center justify-center text-green-700 font-semibold text-xs sm:text-sm">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs sm:text-sm font-medium text-gray-800 truncate">
                            {{ auth()->user()->name ?? 'Petugas' }}
                        </p>
                        <p class="text-[10px] sm:text-xs text-gray-400">Petugas RS</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-3 py-2 text-xs sm:text-sm text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="main-content flex-1 lg:ml-60">
            {{-- Mobile Header --}}
            <div
                class="lg:hidden sticky top-0 z-30 bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between">
                <button onclick="toggleSidebar()" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="flex items-center gap-2">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-8 w-auto">
                    <span class="font-semibold text-gray-800 text-sm">Admin</span>
                </div>
                <div class="w-10"></div>
            </div>

            <div class="p-4 sm:p-6">
                @if(session('success'))
                    <div
                        class="mb-4 p-3 sm:p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 text-xs sm:text-sm flex items-center gap-2 sm:gap-3">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div
                        class="mb-4 p-3 sm:p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-xs sm:text-sm flex items-center gap-2 sm:gap-3">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('active');
        }
    </script>
</body>

</html>