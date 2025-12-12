<x-admin-layout>
    {{-- Header --}}
    <div class="mb-6 sm:mb-8">
        <div class="accent-line mb-3 sm:mb-4"></div>
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-sm text-gray-500 mt-1">Ringkasan status kamar rawat inap RSKIA Sadewa</p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6 sm:mb-8">
        <div class="stat-card p-4 sm:p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-2xl sm:text-3xl font-bold text-gray-800">{{ $stats['total'] }}</p>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">Total Kamar</p>
        </div>

        <div class="stat-card p-4 sm:p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span
                    class="inline-flex items-center gap-1 px-2 py-0.5 text-[10px] sm:text-xs font-semibold text-green-600 bg-green-50 rounded-full">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                    LIVE
                </span>
            </div>
            <p class="text-2xl sm:text-3xl font-bold text-green-600">{{ $stats['tersedia'] }}</p>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">Tersedia</p>
        </div>

        <div class="stat-card p-4 sm:p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-2xl sm:text-3xl font-bold text-red-500">{{ $stats['terisi'] }}</p>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">Terisi</p>
        </div>

        <div class="stat-card p-4 sm:p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-2xl sm:text-3xl font-bold text-amber-500">{{ $stats['dibersihkan'] }}</p>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">Dibersihkan</p>
        </div>
    </div>

    {{-- Occupancy & Chart --}}
    <div class="grid lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
        {{-- Occupancy Rate --}}
        <div class="card p-4 sm:p-6">
            <h3 class="font-semibold text-gray-800 mb-4 text-sm sm:text-base">Tingkat Okupansi</h3>
            <div class="flex items-center justify-center py-4 sm:py-6">
                <div class="relative w-28 h-28 sm:w-36 sm:h-36">
                    <svg class="w-full h-full -rotate-90">
                        <circle cx="50%" cy="50%" r="45%" stroke="#E5E7EB" stroke-width="8" fill="none" />
                        <circle cx="50%" cy="50%" r="45%" stroke="#0CA15C" stroke-width="8" fill="none"
                            stroke-dasharray="{{ $occupancyRate * 2.83 }} 283" stroke-linecap="round" />
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span
                            class="text-2xl sm:text-3xl font-bold text-gray-800">{{ number_format($occupancyRate, 0) }}%</span>
                        <span class="text-xs text-gray-500">Okupansi</span>
                    </div>
                </div>
            </div>
            <div class="text-center text-xs sm:text-sm text-gray-500">
                {{ $stats['terisi'] }} dari {{ $stats['total'] }} kamar terisi
            </div>
        </div>

        {{-- Activity Chart --}}
        <div class="card p-4 sm:p-6 lg:col-span-2">
            <h3 class="font-semibold text-gray-800 mb-4 text-sm sm:text-base">Aktivitas 7 Hari Terakhir</h3>
            <div class="h-48 sm:h-56">
                <canvas id="activityChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Recent Activity & Status --}}
    <div class="grid lg:grid-cols-2 gap-4 sm:gap-6">
        {{-- Recent Activity --}}
        <div class="card p-4 sm:p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-gray-800 text-sm sm:text-base">Aktivitas Terbaru</h3>
                <a href="{{ route('admin.audits') }}" class="text-xs text-green-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="space-y-3">
                @forelse($recentAudits as $audit)
                    <div class="flex items-center gap-3 p-2 sm:p-3 rounded-lg hover:bg-gray-50">
                        <div
                            class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg flex items-center justify-center flex-shrink-0
                            {{ $audit->new_status === 'tersedia' ? 'bg-green-100' : ($audit->new_status === 'terisi' ? 'bg-red-100' : 'bg-amber-100') }}">
                            <svg class="w-4 h-4 {{ $audit->new_status === 'tersedia' ? 'text-green-600' : ($audit->new_status === 'terisi' ? 'text-red-500' : 'text-amber-500') }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-medium text-gray-800 truncate">
                                {{ $audit->room->name ?? 'N/A' }}</p>
                            <p class="text-[10px] sm:text-xs text-gray-500">
                                {{ ucfirst($audit->old_status) }} → {{ ucfirst($audit->new_status) }}
                            </p>
                        </div>
                        <span
                            class="text-[10px] sm:text-xs text-gray-400 flex-shrink-0">{{ $audit->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <p class="text-xs sm:text-sm text-gray-500 text-center py-6">Belum ada aktivitas</p>
                @endforelse
            </div>
        </div>

        {{-- Status Distribution --}}
        <div class="card p-4 sm:p-6">
            <h3 class="font-semibold text-gray-800 mb-4 text-sm sm:text-base">Distribusi Status</h3>
            <div class="space-y-3 sm:space-y-4">
                @php
                    $statuses = [
                        ['name' => 'Tersedia', 'count' => $stats['tersedia'], 'color' => 'green', 'percent' => $stats['total'] > 0 ? ($stats['tersedia'] / $stats['total']) * 100 : 0],
                        ['name' => 'Terisi', 'count' => $stats['terisi'], 'color' => 'red', 'percent' => $stats['total'] > 0 ? ($stats['terisi'] / $stats['total']) * 100 : 0],
                        ['name' => 'Dibersihkan', 'count' => $stats['dibersihkan'], 'color' => 'amber', 'percent' => $stats['total'] > 0 ? ($stats['dibersihkan'] / $stats['total']) * 100 : 0],
                    ];
                @endphp
                @foreach($statuses as $status)
                    <div>
                        <div class="flex justify-between text-xs sm:text-sm mb-1.5">
                            <span class="font-medium text-gray-700">{{ $status['name'] }}</span>
                            <span class="text-gray-500">{{ $status['count'] }}
                                ({{ number_format($status['percent'], 0) }}%)</span>
                        </div>
                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-{{ $status['color'] }}-500 rounded-full transition-all"
                                style="width: {{ $status['percent'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('activityChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Perubahan Status',
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: '#0CA15C',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 11 } }, grid: { color: '#F3F4F6' } },
                    x: { ticks: { font: { size: 10 } }, grid: { display: false } }
                }
            }
        });
    </script>
</x-admin-layout>