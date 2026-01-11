<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk hapus/simpan gambar

class ProdukController extends Controller
{
    /**
     * Tampilan Utama Kelola Menu
     */
    public function index(Request $request)
    {
        $kategoris = Kategori::orderBy('kategori')->get();

        $produks = Produk::with('kategori')
            ->when($request->kategori, function ($q) use ($request) {
                $q->where('kategori_id', $request->kategori);
            })
            ->when($request->search, function ($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'pengguna.owner.Kelola_Menu.index',
            compact('produks', 'kategoris')
        );
    }


    public function create()
    {
        $kategoris = \App\Models\Kategori::all(); // Mengambil semua kategori untuk dropdown
        return view('pengguna.owner.Kelola_Menu.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric',
            'deskripsi'   => 'required|string',
            'stok'        => 'required|integer',
            'gambar'      => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'kategori_id' => 'required', // Sesuaikan dengan tabel kategori kamu
        ]);

        $data = $request->all();

        // Logika Simpan Gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all(); // Mengambil semua kategori untuk dropdown
        return view('pengguna.owner.Kelola_Menu.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, string $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Logika Update Gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus file gambar dari storage sebelum data di DB dihapus
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
