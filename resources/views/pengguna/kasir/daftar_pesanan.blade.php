<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Daftar Pesanan Hari Ini</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Kode</th>
                        <th class="p-3 text-left">Pemesan</th>
                        <th class="p-3 text-center">Metode</th>
                        <th class="p-3 text-right">Total</th>
                        <th class="p-3 text-center">Status</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pesanan as $item)
                        <tr class="border-t" x-data="{ open: false }">

                            {{-- KODE --}}
                            <td class="p-3 font-mono text-orange-600">
                                {{ $item->kode_pesanan }}
                            </td>

                            {{-- PEMESAN --}}
                            <td class="p-3">{{ $item->nama_pemesan }}</td>

                            {{-- METODE --}}
                            <td class="p-3 text-center capitalize">
                                {{ $item->metode_pembayaran }}
                            </td>

                            {{-- TOTAL --}}
                            <td class="p-3 text-right font-bold">
                                Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                            </td>

                            {{-- STATUS --}}
                            <td class="p-3 text-center">
                                @if ($item->status === 'pending')
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">
                                        Menunggu
                                    </span>
                                @else
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                                        Diproses
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="p-3 text-center space-x-2">

                                {{-- DETAIL --}}
                                <button @click="open = true"
                                    class="bg-blue-600 text-white px-3 py-1 rounded text-xs hover:bg-blue-700">
                                    Detail
                                </button>

                                {{-- CASH --}}
                                @if ($item->metode_pembayaran === 'cash' && $item->status === 'pending')
                                    <form action="{{ route('kasir.terima', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button
                                            class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700">
                                            ACC Cash
                                        </button>
                                    </form>
                                @endif

                                {{-- CETAK NOTA (HANYA SETELAH ACC) --}}
                                @if ($item->status !== 'pending')
                                    <a href="{{ route('kasir.nota', $item->id) }}" target="_blank"
                                        class="bg-gray-600 text-white px-3 py-1 rounded text-xs hover:bg-gray-700">
                                        Cetak Nota
                                    </a>
                                @endif

                            </td>

                            {{-- MODAL --}}
                            <td colspan="6">
                                <div x-show="open" x-transition x-cloak
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">

                                    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden">

                                        {{-- HEADER --}}
                                        <div class="flex items-center justify-between px-6 py-4 border-b">
                                            <div>
                                                <h2 class="text-lg font-bold text-gray-800">
                                                    Detail Pesanan
                                                </h2>
                                                <p class="text-xs text-gray-500">
                                                    {{ $item->kode_pesanan }}
                                                </p>
                                            </div>

                                            <button @click="open = false"
                                                class="text-gray-400 hover:text-gray-700 transition">
                                                ✕
                                            </button>
                                        </div>

                                        {{-- BODY --}}
                                        <div class="p-6 space-y-4 text-sm">

                                            {{-- INFO UTAMA --}}
                                            <div class="grid grid-cols-2 gap-3">
                                                <div>
                                                    <p class="text-xs text-gray-500">Pemesan</p>
                                                    <p class="font-semibold text-gray-800">
                                                        {{ $item->nama_pemesan }}
                                                    </p>
                                                </div>

                                                <div>
                                                    <p class="text-xs text-gray-500">Metode Pembayaran</p>
                                                    <span
                                                        class="inline-block mt-1 rounded-full px-3 py-1 text-xs font-semibold
                                                        {{ $item->metode_pembayaran === 'cash' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                                        {{ strtoupper($item->metode_pembayaran) }}
                                                    </span>
                                                </div>
                                            </div>

                                            {{-- DAFTAR ITEM --}}
                                            <div class="border rounded-xl p-4 bg-gray-50">
                                                <p class="font-semibold text-gray-700 mb-2 text-sm">
                                                    Daftar Item
                                                </p>

                                                <div class="space-y-2">
                                                    @forelse (optional($item->keranjang)->item ?? [] as $detail)
                                                        <div class="flex justify-between items-center">
                                                            <span class="text-gray-700">
                                                                {{ $detail->jumlah }}x
                                                                {{ $detail->produk->nama_produk ?? '-' }}
                                                            </span>
                                                        </div>
                                                    @empty
                                                        <p class="text-xs text-gray-500 italic">
                                                            Tidak ada item
                                                        </p>
                                                    @endforelse
                                                </div>
                                            </div>

                                            {{-- CATATAN --}}
                                            @if ($item->catatan)
                                                <div>
                                                    <p class="text-xs text-gray-500 font-semibold mb-1">
                                                        Catatan
                                                    </p>
                                                    <div
                                                        class="rounded-lg bg-yellow-50 border border-yellow-200 p-3 italic text-gray-700">
                                                        {{ $item->catatan }}
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- TOTAL --}}
                                            <div class="flex justify-between items-center pt-3 border-t">
                                                <span class="text-gray-500 text-sm">
                                                    Total Pembayaran
                                                </span>
                                                <span class="text-lg font-bold text-gray-900">
                                                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>

                                        {{-- FOOTER --}}
                                        <div class="px-6 py-4 bg-gray-50 text-right">
                                            <button @click="open = false"
                                                class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-2 rounded-lg text-sm transition">
                                                Tutup
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-6 text-center text-gray-500">
                                Tidak ada pesanan hari ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
