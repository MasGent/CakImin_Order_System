@extends('Pembeli.index')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6 text-center">

        {{-- HEADER --}}
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">
            Pembayaran QRIS
        </h2>
        <p class="text-sm text-gray-500 mb-4">
            Silakan scan QR untuk menyelesaikan pembayaran
        </p>

        {{-- DETAIL PESANAN --}}
        <div class="text-left text-sm bg-gray-100 rounded-xl p-4 mb-4">
            <div class="flex justify-between mb-2">
                <span class="text-gray-600">Kode Pesanan</span>
                <span class="font-medium text-gray-800">
                    {{ $transaksi->kode_pesanan }}
                </span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="text-gray-600">Nama Pemesan</span>
                <span class="font-medium text-gray-800">
                    {{ $transaksi->nama_pemesan }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Total Bayar</span>
                <span class="font-semibold text-lg text-green-600">
                    Rp {{ number_format($transaksi->total_harga) }}
                </span>
            </div>
        </div>

        {{-- QR CODE --}}
        <div class="bg-white border rounded-xl p-4 mb-4">
            <img src="{{ $qrisUrl }}"
                 alt="QRIS Payment"
                 class="mx-auto w-56 h-56 object-contain">
        </div>

        {{-- INFO --}}
        <p class="text-xs text-gray-500">
            QRIS berlaku selama ±5 menit.<br>
            Setelah pembayaran berhasil, status akan diperbarui otomatis.
        </p>

        {{-- LOADING STATUS (OPSIONAL UI) --}}
        <div class="mt-4 flex justify-center items-center gap-2 text-sm text-gray-500">
            <svg class="animate-spin h-4 w-4 text-gray-400" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4" fill="none"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8z"></path>
            </svg>
            Menunggu pembayaran...
        </div>

    </div>
</div>
<script>
    setInterval(() => {
        fetch('/cek-status/{{ $transaksi->id }}')
            .then(res => res.json())
            .then(data => {
                if (data.status === 'diproses') {
    window.location.href = "/pesanan/sukses/{{ $transaksi->id }}";
}

            });
    }, 4000); // cek tiap 4 detik
</script>
@endsection
