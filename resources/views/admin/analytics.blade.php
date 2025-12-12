<x-admin-layout>
    {{-- Header --}}
    <div class="mb-6 sm:mb-8">
        <div class="accent-line mb-3 sm:mb-4"></div>
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Analytics Ketersediaan</h1>
        <p class="text-sm text-gray-500 mt-1">Analisis data ketersediaan kamar rawat inap</p>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5 mb-6 sm:mb-8">
        <div class="stat-card p-4 sm:p-5">
            <p class="text-xs sm:text-sm text-gray-500 mb-2">Rata-rata Okupansi</p>
            <p class="text-2xl sm:text-3xl font-bold text-gray-800">{{ $analytics['avgOccupancy'] }}%</p>
            <p class="text-[10px] sm:text-xs text-gray-400 mt-1">7 hari terakhir</p>
        </div>
        <div class="stat-card p-4 sm:p-5">
            <p class="text-xs sm:text-sm text-gray-500 mb-2">Total Perubahan</p>
            <p class="text-2xl sm:text-3xl font-bold text-gray-800">{{ $analytics['totalChanges'] }}</p>
            <p class="text-[10px] sm:text-xs text-gray-400 mt-1">7 hari terakhir</p>
        </div>
        <div class="stat-card p-4 sm:p-5">
            <p class="text-xs sm:text-sm text-gray-500 mb-2">Kamar Aktif</p>
            <p class="text-2xl sm:text-3xl font-bold text-green-600">{{ $analytics['activeRooms'] }}</p>
            <p class="text-[10px] sm:text-xs text-gray-400 mt-1">Total terdaftar</p>
        </div>
        <div class="stat-card p-4 sm:p-5">
            <p class="text-xs sm:text-sm text-gray-500 mb-2">Perubahan Hari Ini</p>
            <p class="text-2xl sm:text-3xl font-bold text-blue-600">{{ $analytics['todayChanges'] }}</p>
            <p class="text-[10px] sm:text-xs text-gray-400 mt-1">{{ now()->format('d M Y') }}</p>
        </div>
    </div>

    {{-- Charts Row 1 --}}
    <div class="grid lg:grid-cols-2 gap-4 sm:gap-6 mb-4 sm:mb-6">
        {{-- Daily Chart --}}
        <div class="card p-4 sm:p-5">
            <p class="font-semibold text-gray-800 mb-4 text-sm sm:text-base">Perubahan Status per Hari</p>
            <div class="h-48 sm:h-56">
                <canvas id="dailyChart"></canvas>
            </div>
        </div>

        {{-- Status Distribution --}}
        <div class="card p-4 sm:p-5">
            <p class="font-semibold text-gray-800 mb-4 text-sm sm:text-base">Distribusi Status Saat Ini</p>
            <div class="h-48 sm:h-56 flex items-center justify-center">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Charts Row 2 --}}
    <div class="grid lg:grid-cols-3 gap-4 sm:gap-6 mb-4 sm:mb-6">
        {{-- By Floor --}}
        <div class="card p-4 sm:p-5 lg:col-span-2">
            <p class="font-semibold text-gray-800 mb-4 text-sm sm:text-base">Distribusi per Lantai</p>
            <div class="h-44 sm:h-52">
                <canvas id="floorChart"></canvas>
            </div>
        </div>

        {{-- Ring Progress --}}
        <div class="card p-4 sm:p-5">
            <p class="font-semibold text-gray-800 mb-4 text-sm sm:text-base">Tingkat Ketersediaan</p>
            <div class="flex flex-col items-center justify-center h-40 sm:h-48">
                <div class="relative w-28 h-28 sm:w-32 sm:h-32">
                    <svg class="w-full h-full transform -rotate-90">
                        <circle cx="50%" cy="50%" r="45%" stroke="#E5E7EB" stroke-width="8" fill="none" />
                        <circle cx="50%" cy="50%" r="45%" stroke="#0CA15C" stroke-width="8" fill="none"
                            stroke-dasharray="{{ $analytics['availabilityRate'] * 2.83 }} 283" stroke-linecap="round" />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span
                            class="text-xl sm:text-2xl font-bold text-gray-800">{{ $analytics['availabilityRate'] }}%</span>
                    </div>
                </div>
                <p class="text-xs sm:text-sm text-gray-500 mt-3">Kamar Tersedia</p>
            </div>
        </div>
    </div>

    {{-- Insights --}}
    <div class="card p-4 sm:p-5">
        <p class="font-semibold text-gray-800 mb-4 text-sm sm:text-base">Insight</p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
            <div class="p-3 sm:p-4 bg-green-50 rounded-xl">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium text-green-800 text-xs sm:text-sm">Ketersediaan Baik</span>
                </div>
                <p class="text-xs sm:text-sm text-green-700">{{ $analytics['availabilityRate'] }}% kamar tersedia untuk
                    pasien baru</p>
            </div>
            <div class="p-3 sm:p-4 bg-blue-50 rounded-xl">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="font-medium text-blue-800 text-xs sm:text-sm">Aktivitas</span>
                </div>
                <p class="text-xs sm:text-sm text-blue-700">{{ $analytics['totalChanges'] }} perubahan status dalam 7
                    hari terakhir</p>
            </div>
            <div class="p-3 sm:p-4 bg-yellow-50 rounded-xl sm:col-span-2 lg:col-span-1">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium text-yellow-800 text-xs sm:text-sm">Update Terbaru</span>
                </div>
                <p class="text-xs sm:text-sm text-yellow-700">Terakhir diperbarui {{ now()->format('d M Y, H:i') }} WIB
                </p>
            </div>
        </div>
    </div>

    <script>
        // Daily Chart
        const dailyCtx = document.getElementById('dailyChart').getContext('2d');
        const dailyData = @json($analytics['dailyData']);

        new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: dailyData.map(d => d.date),
                datasets: [{
                    label: 'Perubahan',
                    data: dailyData.map(d => d.changes),
                    borderColor: '#0CA15C',
                    backgroundColor: 'rgba(12, 161, 92, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#0CA15C',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#F3F4F6' }, ticks: { font: { size: 10 } } },
                    x: { grid: { display: false }, ticks: { font: { size: 10 } } }
                }
            }
        });

        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusData = @json($analytics['statusData']);

        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Tersedia', 'Terisi', 'Dibersihkan'],
                datasets: [{
                    data: [statusData.tersedia, statusData.terisi, statusData.dibersihkan],
                    backgroundColor: ['#0CA15C', '#EF4444', '#F59E0B'],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { font: { size: 11 }, padding: 15 } } },
                cutout: '65%',
            }
        });

        // Floor Chart
        const floorCtx = document.getElementById('floorChart').getContext('2d');
        const floorData = @json($analytics['floorData']);

        new Chart(floorCtx, {
            type: 'bar',
            data: {
                labels: floorData.map(d => 'Lt ' + d.floor),
                datasets: [
                    { label: 'Tersedia', data: floorData.map(d => d.tersedia), backgroundColor: '#0CA15C', borderRadius: 4 },
                    { label: 'Terisi', data: floorData.map(d => d.terisi), backgroundColor: '#EF4444', borderRadius: 4 },
                    { label: 'Dibersihkan', data: floorData.map(d => d.dibersihkan), backgroundColor: '#F59E0B', borderRadius: 4 }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { font: { size: 10 }, padding: 10 } } },
                scales: {
                    y: { beginAtZero: true, stacked: true, grid: { color: '#F3F4F6' }, ticks: { font: { size: 10 } } },
                    x: { stacked: true, grid: { display: false }, ticks: { font: { size: 10 } } }
                }
            }
        });
    </script>
</x-admin-layout>