@extends('Pembeli.index')

@section('content')
    <div class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-6">

        {{-- CARD --}}
        <div class="bg-white w-full max-w-md sm:max-w-lg  rounded-2xl shadow-xl p-6 sm:p-8 text-center">

            {{-- ICON --}}
            <div class="flex justify-center mb-5">
                <div class="bg-green-100 text-green-600 rounded-full p-4 sm:p-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 sm:h-12 sm:w-12" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            {{-- TITLE --}}
            <h1 class="text-xl sm:text-2xl font-extrabold text-gray-800 mb-2">
                Pesanan Berhasil 🎉
            </h1>

            {{-- DESCRIPTION --}}
            <p class="text-sm sm:text-base text-orange-600 mb-6 leading-relaxed">
                @if ($transaksi->metode_pembayaran === 'cash')
                    Pesanan Anda berhasil dibuat. Silakan lakukan pembayaran di kasir agar pesanan dapat segera diproses.
                @else
                    Pembayaran berhasil diterima. Pesanan Anda sedang diproses oleh dapur.
                @endif
            </p>

            {{-- INFO PESANAN --}}
            <div class="bg-gray-50 rounded-xl p-4 sm:p-5 text-left space-y-3 mb-6">

                <div class="flex justify-between text-xs sm:text-sm">
                    <span class="text-gray-500">Kode Pesanan</span>
                    <span class="font-mono font-bold text-orange-600">
                        {{ $transaksi->kode_pesanan }}
                    </span>
                </div>

                <div class="flex justify-between text-xs sm:text-sm">
                    <span class="text-gray-500">Metode Pembayaran</span>
                    <span class="font-semibold capitalize">
                        {{ $transaksi->metode_pembayaran }}
                    </span>
                </div>

                <div class="flex justify-between text-xs sm:text-sm">
                    <span class="text-gray-500">Status Pesanan</span>
                    @if ($transaksi->status === 'pending')
                        <span class="font-semibold text-yellow-600">
                            Menunggu Pembayaran
                        </span>
                    @elseif ($transaksi->status === 'diproses')
                        <span class="font-semibold text-blue-600">
                            Sedang Diproses
                        </span>
                    @else
                        <span class="font-semibold text-green-600">
                            Selesai
                        </span>
                    @endif
                </div>
            </div>

            {{-- DAFTAR PESANAN --}}
            @if ($keranjang && $keranjang->item->count())
            <div class="bg-gray-50 rounded-xl p-4 sm:p-5 text-left mb-6">

                {{-- DROPDOWN HEADER --}}
                <button
                    type="button"
                    onclick="togglePesanan()"
                    class="w-full flex justify-between items-center font-bold text-gray-700 text-sm sm:text-base">

                    <span>Daftar Pesanan ({{ $keranjang->item->count() }} Item)</span>

                    <svg id="icon-pesanan"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 transition-transform duration-300"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                {{-- DROPDOWN CONTENT --}}
                <div id="dropdown-pesanan"
                    class="mt-4 space-y-3 overflow-hidden transition-all duration-300 hidden">

                    @foreach ($keranjang->item as $item)
                        <div class="flex justify-between items-start border-b pb-3">
                            <div class="pr-2">
                                <p class="font-semibold text-gray-800 text-sm sm:text-base leading-tight">
                                    {{ $item->produk->nama_produk }}
                                </p>
                                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                                    {{ $item->jumlah }} × Rp
                                    {{ number_format($item->produk->harga, 0, ',', '.') }}
                                </p>
                            </div>
                            <span class="font-bold text-gray-700 text-sm sm:text-base whitespace-nowrap">
                                Rp {{ number_format($item->jumlah * $item->produk->harga, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach
                </div>

                {{-- TOTAL --}}
                <div class="flex justify-between mt-4 text-sm sm:text-base font-bold border-t pt-3">
                    <span>Total</span>
                    <span class="text-orange-600">
                        Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                    </span>
                </div>

            </div>
            @endif


            {{-- ACTION --}}
            <!-- <div class="space-y-3">
                <a href="{{ route('daftar_menu') }}"
                    class="block w-full bg-orange-600 text-white font-bold py-3 sm:py-4 rounded-xl
                       hover:bg-orange-700 active:scale-[0.98] transition">
                    Pesan Lagi
                </a>
            </div> -->

        </div>
    </div>

    <script>
        function togglePesanan() {
            const dropdown = document.getElementById('dropdown-pesanan');
            const icon = document.getElementById('icon-pesanan');

            dropdown.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }
        </script>

@endsection
