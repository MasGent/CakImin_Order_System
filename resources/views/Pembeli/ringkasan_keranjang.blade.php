@extends('Pembeli.index')

@section('content')
<div class="bg-gray-100 min-h-screen flex justify-center">

    {{-- CONTAINER --}}
    <div class="w-full max-w-md sm:max-w-lg md:max-w-xl bg-white min-h-screen shadow-lg flex flex-col">

        {{-- HEADER --}}
        <div class="sticky top-0 z-20 bg-white border-b px-4 py-4 flex items-center gap-3">
            <a href="{{ route('daftar_menu') }}" class="text-gray-600 hover:text-orange-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-lg sm:text-xl font-bold text-gray-800">Ringkasan Pesanan</h1>
                <p class="text-xs sm:text-sm text-gray-500">Periksa kembali sebelum konfirmasi</p>
            </div>
        </div>

        {{-- ALERT --}}
        @if (session('error'))
            <div class="mx-4 mt-4 bg-red-100 text-red-700 px-4 py-3 rounded-xl text-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- LIST ITEM --}}
        <div class="flex-1 px-4 py-4 space-y-4 overflow-y-auto">
            @forelse ($keranjang->item as $item)
                <div class="flex justify-between gap-3 border-b pb-4">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 text-sm sm:text-base leading-tight">
                            {{ $item->produk->nama_produk }}
                        </h3>
                        <p class="text-xs sm:text-sm text-gray-500 mt-1">
                            {{ $item->jumlah }} × Rp
                            {{ number_format($item->produk->harga, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="font-bold text-gray-800 text-sm sm:text-base whitespace-nowrap">
                        Rp {{ number_format($item->jumlah * $item->produk->harga, 0, ',', '.') }}
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center text-gray-500 py-20">
                    <span class="text-4xl mb-2">🛒</span>
                    <p class="text-sm sm:text-base">Keranjang masih kosong</p>
                </div>
            @endforelse
        </div>

        {{-- TOTAL --}}
        <div class="px-4 py-4 bg-orange-50 border-t">
            <div class="flex justify-between items-center">
                <span class="text-gray-600 font-medium text-sm sm:text-base">
                    Total Pembayaran
                </span>
                <span class="text-xl sm:text-2xl font-black text-orange-600">
                    Rp {{ number_format($totalHarga, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- FORM CHECKOUT --}}
        <div class="px-4 py-4">
            <form action="{{ route('checkout') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Pemesan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_pemesan" required
                        class="w-full border rounded-xl px-4 py-3 text-sm sm:text-base
                               focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
                </div>

                {{-- Metode Pembayaran --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Metode Pembayaran <span class="text-red-500">*</span>
                    </label>
                    <select name="metode_pembayaran"
                        class="w-full border rounded-xl px-4 py-3 text-sm sm:text-base outline-none">
                        <option value="cash">Cash (Bayar di Kasir)</option>
                        <option value="qris">QRIS</option>
                    </select>
                </div>

                {{-- Catatan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Catatan <span class="text-gray-400 italic">(Opsional)</span>
                    </label>
                    <textarea name="catatan" rows="2"
                        class="w-full border rounded-xl px-4 py-3 text-sm sm:text-base outline-none"
                        placeholder="Contoh: tanpa sambal, es terpisah..."></textarea>
                </div>

                {{-- BUTTON --}}
                <button type="submit"
                    @if ($keranjang->item->isEmpty()) disabled @endif
                    class="w-full py-4 rounded-xl font-bold text-base shadow-lg transition
                        {{ $keranjang->item->isEmpty()
                            ? 'bg-gray-300 text-gray-500 cursor-not-allowed'
                            : 'bg-orange-600 text-white hover:bg-orange-700 active:scale-[0.98]' }}">
                    Konfirmasi Pesanan
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
