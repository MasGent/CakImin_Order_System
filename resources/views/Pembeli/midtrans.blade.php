@extends('Pembeli.index')

@section('content')
<div class="container text-center">
    <h2 class="mb-3">Pembayaran QRIS</h2>

    <p><strong>Kode Pesanan:</strong> {{ $transaksi->kode_pesanan }}</p>
    <p><strong>Nama Pemesan:</strong> {{ $transaksi->nama_pemesan }}</p>
    <p><strong>Total Bayar:</strong> Rp {{ number_format($transaksi->total_harga) }}</p>

    <hr>

    <p class="mb-3">Silakan scan QRIS di bawah ini</p>

    <img src="{{ $qrisUrl }}" 
         alt="QRIS Payment"
         style="max-width:300px"
         class="img-fluid mx-auto d-block">

    <p class="mt-3 text-muted">
        QRIS berlaku selama ±5 menit
    </p>
</div>
@endsection
