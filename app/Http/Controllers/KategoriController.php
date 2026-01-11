<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        // withCount akan menghitung jumlah data di tabel produk yang terhubung
        $kategoris = Kategori::withCount('produk')->latest()->paginate(10);

        return view('pengguna.owner.Kelola_Kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('pengguna.owner.Kelola_Kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255|unique:kategori,kategori',
        ]);

        Kategori::create([
            'kategori' => $request->kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('pengguna.owner.Kelola_Kategori.edit', compact('kategori'));
    }

    public function update(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'kategori' => 'required|string|max:255|unique:kategori,kategori,' . $id,
        ]);

        $kategori->update([
            'kategori' => $request->kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diubah.');
    }

    public function destroy(string $id)
    {
    $kategori = Kategori::withCount('produks')->findOrFail($id);

    if ($kategori->produks_count > 0) {
        return redirect()->back()->with('error', "Kategori '$kategori->kategori' tidak bisa dihapus karena masih digunakan oleh $kategori->produks_count menu!");
    }

    $kategori->delete();
    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
