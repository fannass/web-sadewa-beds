<x-admin-layout>
    <!-- Header -->
    <div class="mb-8">
        <div class="accent-line mb-4"></div>
        <h1 class="text-2xl font-bold text-gray-800">Audit Log</h1>
        <p class="text-gray-500 mt-1">Riwayat perubahan status kamar rawat inap</p>
    </div>

    <!-- Filter -->
    <div class="card p-4 mb-6">
        <form method="GET" class="flex flex-wrap items-center gap-3">
            <input type="date" name="date" value="{{ request('date') }}"
                class="px-4 py-2.5 text-sm rounded-lg border border-gray-200 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none">
            <select name="status"
                class="px-4 py-2.5 text-sm rounded-lg border border-gray-200 bg-white focus:border-green-500 outline-none">
                <option value="">Semua Status</option>
                <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="terisi" {{ request('status') === 'terisi' ? 'selected' : '' }}>Terisi</option>
                <option value="dibersihkan" {{ request('status') === 'dibersihkan' ? 'selected' : '' }}>Dibersihkan
                </option>
            </select>
            <button type="submit" class="btn-primary px-5 py-2.5 text-sm font-medium rounded-lg">Filter</button>
            <a href="{{ route('admin.audits') }}"
                class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">Reset</a>
        </form>
    </div>

    <!-- Audit Table -->
    <div class="card overflow-hidden">
        <table class="table-clean w-full">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Kamar</th>
                    <th>Status Lama</th>
                    <th>Status Baru</th>
                    <th>Petugas</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($audits as $audit)
                    <tr>
                        <td>
                            <p class="font-medium text-gray-800">{{ $audit->created_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-400">{{ $audit->created_at->format('H:i') }} WIB</p>
                        </td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $audit->room->name ?? '-' }}</p>
                                    <p class="text-xs text-gray-400">{{ $audit->room->room_type ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($audit->old_status)
                                <span
                                    class="px-2 py-1 rounded-lg text-xs font-medium status-{{ $audit->old_status }}">{{ ucfirst($audit->old_status) }}</span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td>
                            <span
                                class="px-2 py-1 rounded-lg text-xs font-medium status-{{ $audit->new_status }}">{{ ucfirst($audit->new_status) }}</span>
                        </td>
                        <td>
                            <p class="text-gray-700">{{ $audit->user->name ?? 'Sistem' }}</p>
                        </td>
                        <td>
                            <p class="text-sm text-gray-500">{{ $audit->notes ?? '-' }}</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-12 text-gray-400">Belum ada data audit</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($audits->hasPages())
            <div class="p-4 border-t border-gray-100">{{ $audits->links() }}</div>
        @endif
    </div>
</x-admin-layout>