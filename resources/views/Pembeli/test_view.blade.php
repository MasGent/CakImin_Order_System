@extends('Pembeli.index')

@section('content')
<div class="bg-gray-50 min-h-screen px-4 py-6">
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        {{-- Header --}}
        <div class="p-5 text-center border-b">
            <div class="flex justify-center mb-3">
                <div class="bg-green-100 text-green-600 rounded-full p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <h1 class="text-xl font-bold text-gray-800">Pesanan Berhasil</h1>
            <p class="text-sm text-gray-500 mt-1">
                Pesanan sedang diproses oleh dapur
            </p>
        </div>

        {{-- Info Pesanan --}}
        <div class="p-4 bg-gray-50 text-sm space-y-2">
            <div class="flex justify-between">
                <span class="text-gray-500">Kode Pesanan</span>
                <span class="font-mono font-bold text-orange-600">
                    {{ $keranjang->kode_pesanan }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Nomor Meja</span>
                <span class="font-semibold">
                    Meja {{ $keranjang->meja->nomor_meja }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Status</span>
                <span class="font-semibold text-yellow-600">
                    {{ ucfirst($keranjang->status) }}
                </span>
            </div>
        </div>

        {{-- Daftar Pesanan --}}
        <div class="p-4">
            <h2 class="font-bold text-gray-800 mb-3">🍽️ Daftar Pesanan</h2>

            <div class="space-y-3">
                @foreach ($keranjang->item as $item)
                    <div class="flex justify-between items-center border-b pb-2">
                        <div>
                            <p class="font-semibold text-gray-800">
                                {{ $item->produk->nama_produk }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $item->jumlah }} x Rp
                                {{ number_format($item->produk->harga, 0, ',', '.') }}
                            </p>
                        </div>

                        <span class="font-bold text-gray-800">
                            Rp {{ number_format($item->jumlah * $item->produk->harga, 0, ',', '.') }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Total --}}
        <div class="p-4 bg-orange-50 flex justify-between items-center">
            <span class="font-medium text-gray-600">Total Pembayaran</span>
            <span class="text-xl font-black text-orange-600">
                Rp {{ number_format(
                    $keranjang->item->sum(fn($i) => $i->jumlah * $i->produk->harga),
                    0, ',', '.'
                ) }}
            </span>
        </div>

        {{-- Action --}}
        <div class="p-4 space-y-3">
            <a href="{{ route('daftar_menu') }}"
                class="block w-full bg-orange-600 text-white font-bold py-3 rounded-xl text-center hover:bg-orange-700 transition">
                Pesan Lagi
            </a>
        </div>

    </div>
</div>
@endsection
