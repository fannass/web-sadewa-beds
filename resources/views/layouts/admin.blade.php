<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sadewa Beds') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #0d9488;
            --primary-dark: #0f766e;
            --secondary: #6366f1;
            --background: #0f172a;
            --surface: #1e293b;
            --surface-light: #334155;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--background) 0%, #1a1f35 100%);
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.8) 0%, rgba(51, 65, 85, 0.6) 100%);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .sidebar {
            background: linear-gradient(180deg, rgba(30, 41, 59, 0.95) 0%, rgba(15, 23, 42, 0.98) 100%);
            backdrop-filter: blur(20px);
        }

        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
        }

        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-tersedia {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
        }

        .badge-terisi {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .badge-dibersihkan {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(13, 148, 136, 0.4);
        }

        .table-modern {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-modern th {
            background: rgba(51, 65, 85, 0.5);
            color: var(--text-secondary);
            font-weight: 600;
            padding: 16px;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table-modern td {
            padding: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: var(--text-primary);
        }

        .table-modern tr:hover td {
            background: rgba(51, 65, 85, 0.3);
        }

        .activity-item {
            transition: all 0.3s ease;
        }

        .activity-item:hover {
            background: rgba(51, 65, 85, 0.3);
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(13, 148, 136, 0.4);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(13, 148, 136, 0);
            }
        }

        .pulse-dot {
            animation: pulse-glow 2s infinite;
        }
    </style>
</head>

<body class="antialiased text-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar w-64 fixed h-full z-50 flex flex-col border-r border-white/5">
            <!-- Logo -->
            <div class="p-6 border-b border-white/10">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-500 to-indigo-500 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <span
                        class="text-xl font-bold bg-gradient-to-r from-teal-400 to-indigo-400 bg-clip-text text-transparent">Sadewa
                        Beds</span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'active text-white' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.rooms.index') }}"
                    class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white {{ request()->routeIs('admin.rooms.*') ? 'active text-white' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                    Rooms
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile
                </a>
            </nav>

            <!-- User Info -->
            <div class="p-4 border-t border-white/10">
                <div class="flex items-center gap-3 mb-3">
                    <div
                        class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-500 to-indigo-500 flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-400">Administrator</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <!-- Flash Messages -->
            @if(session('success'))
                <div
                    class="mb-6 p-4 rounded-xl bg-green-500/20 border border-green-500/50 text-green-400 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div
                    class="mb-6 p-4 rounded-xl bg-red-500/20 border border-red-500/50 text-red-400 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>
</body>

</html>