<x-app-layout>
    <div class="bg-gray-100 min-h-screen p-6">

        <h1 class="text-2xl font-bold mb-4">
            🍽️ Detail Pesanan
        </h1>

        <div class="bg-white rounded-xl shadow p-4 mb-6">
            <p><strong>Kode:</strong> {{ $pesanan->kode_pesanan }}</p>
            <p><strong>Pemesan:</strong> {{ $pesanan->nama_pemesan }}</p>

            @if ($pesanan->catatan)
                <p class="mt-2 text-red-600">
                    📝 Catatan: {{ $pesanan->catatan }}
                </p>
            @endif
        </div>

        {{-- DAFTAR MENU --}}
        <div class="bg-white rounded-xl shadow p-4 mb-6">
            <h2 class="font-bold mb-3">🍳 Menu Dipesan</h2>

            @foreach ($pesanan->keranjang->item as $item)
                <div class="flex justify-between border-b py-2">
                    <span>{{ $item->produk->nama_produk }}</span>
                    <strong>x{{ $item->jumlah }}</strong>
                </div>
            @endforeach
        </div>

        {{-- KONFIRMASI --}}
        <form action="{{ route('dapur.selesai', $pesanan->id) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-xl hover:bg-green-700">
                ✔ Tandai Pesanan Selesai
            </button>
        </form>

    </div>
</x-app-layout>
