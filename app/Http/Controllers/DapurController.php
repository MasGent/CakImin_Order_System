<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class DapurController extends Controller
{
    public function stok()
    {
        $produks = Produk::with('kategori')->orderBy('nama_produk')->get();
        return view('pengguna.dapur.stok', compact('produks'));
    }

    public function tambahStok(Request $request, Produk $produk)
    {
        $request->validate([
            'stok_tambah' => 'required|integer|min:1'
        ]);

        $produk->increment('stok', $request->stok_tambah);

        return back()->with('success', 'Stok berhasil ditambahkan');
    }
}
