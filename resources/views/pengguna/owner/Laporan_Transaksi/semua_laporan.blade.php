<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 py-6">

        {{-- HEADER --}}
        <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Laporan Transaksi Bulan {{ $labelBulan ?? '-' }}
                </h2>
                <p class="text-sm text-gray-500">
                    Laporan riwayat pesanan dan total pendapatan.
                </p>
            </div>

            <div class="rounded-xl bg-gray-900 px-5 py-3 text-white shadow">
                <span class="block text-xs opacity-70">Total Omzet</span>
                <span class="text-lg font-semibold">
                    Rp {{ number_format($totalOmzet ?? 0, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- FILTER BULAN --}}
        <div class="mb-6 rounded-xl bg-white p-6 shadow ring-1 ring-gray-200">
            <form method="GET" action="{{ route('laporan.transaksi.bulanan') }}"
                class="flex flex-col gap-4 md:flex-row md:items-end">

                <div>
                    <label class="mb-1 block text-xs font-semibold text-gray-500">
                        Pilih Bulan
                    </label>
                    <input type="month" name="bulan" value="{{ request('bulan', $bulan ?? now()->format('Y-m')) }}"
                        max="{{ now()->format('Y-m') }}" class="rounded-lg border-gray-300 text-sm">
                </div>


                <button type="submit"
                    class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800">
                    Tampilkan
                </button>

                @if (!empty($bulan))
                    <a href="{{ route('laporan.transaksi.bulanan.cetak', ['bulan' => $bulan]) }}" target="_blank"
                        class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">
                        Cetak PDF
                    </a>
                @endif
            </form>

            @if ($errors->any())
                <div class="mt-3 text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- TABLE --}}
        <div class="overflow-hidden rounded-xl bg-white shadow ring-1 ring-gray-200">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left">Transaksi</th>
                        <th class="px-4 py-3 text-left">Pelanggan</th>
                        <th class="px-4 py-3 text-left">Pesanan</th>
                        <th class="px-4 py-3 text-right">Total</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Metode</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($transaksis as $t)
                        <tr class="hover:bg-gray-50">

                            {{-- TRANSAKSI --}}
                            <td class="px-4 py-3">
                                <div class="font-semibold text-gray-900">
                                    {{ $t->kode_pesanan }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $t->created_at->format('d M Y, H:i') }} WIB
                                </div>
                            </td>

                            {{-- PELANGGAN --}}
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-800">
                                    {{ $t->nama_pemesan }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    User ID: #{{ $t->user_id ?? '-' }}
                                </div>
                            </td>

                            {{-- PESANAN --}}
                            <td class="px-4 py-3 text-xs text-gray-700">
                                @forelse (optional($t->keranjang)->item ?? [] as $item)
                                    <div>• {{ $item->jumlah }}x {{ $item->produk->nama_produk ?? '-' }}</div>
                                @empty
                                    <span class="italic text-gray-400">Tidak ada item</span>
                                @endforelse
                            </td>

                            {{-- TOTAL --}}
                            <td class="px-4 py-3 text-right font-semibold">
                                Rp {{ number_format($t->total_harga, 0, ',', '.') }}
                            </td>

                            {{-- STATUS --}}
                            <td class="px-4 py-3 text-center">
                                @php
                                    $statusClass = match ($t->status) {
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'diproses' => 'bg-blue-100 text-blue-700',
                                        default => 'bg-green-100 text-green-700',
                                    };
                                @endphp
                                <span class="rounded-full px-3 py-1 text-xs {{ $statusClass }}">
                                    {{ ucfirst($t->status) }}
                                </span>
                            </td>

                            {{-- METODE --}}
                            <td class="px-4 py-3 text-center text-xs font-semibold text-gray-600">
                                {{ strtoupper($t->metode_pembayaran ?? '-') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-gray-500">
                                Tidak ada transaksi pada bulan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $transaksis->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
