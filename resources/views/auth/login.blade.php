<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Petugas - RSKIA Sadewa</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />
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

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Top accent line -->
            <div class="h-1 bg-green-600"></div>

            <div class="p-8">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-14 mx-auto mb-4"
                        onerror="this.parentElement.innerHTML='<div class=\'w-14 h-14 mx-auto rounded-xl bg-green-600 flex items-center justify-center text-white font-bold text-lg mb-4\'>RS</div><h1 class=\'text-xl font-bold text-gray-800\'>RSKIA Sadewa</h1><p class=\'text-sm text-gray-500\'>Login Petugas</p>'">
                    <h1 class="text-xl font-bold text-gray-800">RSKIA Sadewa</h1>
                    <p class="text-sm text-gray-500">Login Petugas Rumah Sakit</p>
                </div>

                @if (session('status'))
                    <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none transition-all"
                            placeholder="admin@rskiasadewa.com">
                        @error('email')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none transition-all"
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center mb-6">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                        <label for="remember_me" class="ml-2 text-sm text-gray-600">Ingat saya</label>
                    </div>

                    <button type="submit"
                        class="w-full btn-primary py-3 px-4 text-sm font-semibold rounded-xl transition-all">
                        Masuk ke Dashboard
                    </button>
                </form>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-green-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        <p class="text-center text-xs text-gray-400 mt-4">
            Layanan Informasi Ketersediaan Kamar Rawat Inap
        </p>
    </div>
</body>

</html>