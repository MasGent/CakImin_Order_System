<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;

class MejaController extends Controller
{
    public function index()
    {
        $meja = Meja::all();
        return view('pengguna.owner.Kelola_Meja.index', compact('meja'));
    }

    public function create()
    {
        return view('pengguna.owner.Kelola_Meja.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required|integer|unique:meja,nomor_meja',
        ]);

        // Generate QR access
        $qr_access = rand(10000, 99999);
        $url = url('/pesan/' . $qr_access);

        // Simpan meja dulu
        $meja = Meja::create([
            'nomor_meja' => $request->nomor_meja,
            'qr_access'  => $qr_access,
        ]);

        // Tentukan path output
        $qrPath = 'qrcodes/meja-' . $meja->id . '.png';

        // Generate QR tanpa Imagick
        $result = Builder::create()
            ->data($url)
            ->size(300)
            ->margin(10)
            ->build();

        // Simpan file ke public
        $result->saveToFile(public_path($qrPath));

        // Simpan path ke DB
        $meja->update([
            'qr_image' => $qrPath
        ]);

        return redirect()->route('meja.index')->with('success', 'Meja berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $meja = Meja::findOrFail($id);
        return view('pengguna.owner.Kelola_Meja.edit', compact('meja'));
    }

    public function update(Request $request, $id)
    {
        $meja = Meja::findOrFail($id);

        $request->validate([
            'nomor_meja' => 'required|integer|unique:meja,nomor_meja,' . $meja->id,
        ]);

        $meja->update([
            'nomor_meja' => $request->nomor_meja,
        ]);

        return redirect()->route('meja.index')->with('success', 'Meja berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $meja = Meja::findOrFail($id);

        // Hapus file QR
        if ($meja->qr_image && file_exists(public_path($meja->qr_image))) {
            unlink(public_path($meja->qr_image));
        }

        $meja->delete();

        return redirect()->route('meja.index')->with('success', 'Meja berhasil dihapus.');
    }

    public function downloadQr($id)
    {
        $meja = Meja::findOrFail($id);

        if (!$meja->qr_image || !file_exists(public_path($meja->qr_image))) {
            abort(404);
        }

        return response()->download(
            public_path($meja->qr_image),
            'QR-Meja-' . $meja->nomor_meja . '.png'
        );
    }
}
