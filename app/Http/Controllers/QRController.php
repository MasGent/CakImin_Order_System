<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Cart;
use App\Models\keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QRController extends Controller
{
    public function scan($qr_access)
    {
        // Cari meja berdasarkan qr_access
        $meja = Meja::where('qr_access', $qr_access)->first();

        if (!$meja) {
            return abort(404, 'QR Code tidak valid atau meja tidak ditemukan');
        }

        // Cek apakah sudah ada cart pending untuk meja ini
        $cart = keranjang::where('meja_id', $meja->id)
            ->where('status', 'pending')
            ->first();

        if (!$cart) {
            // Buat cart baru
            $cart = keranjang::create([
                'kode_pesanan' => 'CK' . strtoupper(Str::random(6)),
                'meja_id' => $meja->id,
                'status' => 'pending'
            ]);
        }

        // Redirect ke halaman pemesanan
        return view('Pembeli.Daftar_Produk', [
            'cartId' => $cart->id
        ]);
    }
}
