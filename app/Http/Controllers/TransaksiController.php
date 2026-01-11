<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    /**
     * Menampilkan semua laporan transaksi dengan filter rentang waktu.
     */
    public function laporanBulanan(Request $request)
    {
        $request->validate([
            'bulan' => 'nullable|date_format:Y-m',
        ]);

        $bulan = $request->bulan
            ? Carbon::createFromFormat('Y-m', $request->bulan)
            : Carbon::now();

        $start = $bulan->copy()->startOfMonth();
        $end   = $bulan->copy()->endOfMonth();

        // 🔒 LAPORAN = HANYA TRANSAKSI SELESAI
        $query = Transaksi::with(['keranjang.item.produk'])
            ->where('status', 'selesai')
            ->whereBetween('created_at', [$start, $end]);

        $totalOmzet = (clone $query)->sum('total_harga');

        $transaksis = $query->latest()->paginate(10);

        return view('pengguna.owner.Laporan_Transaksi.semua_laporan', [
            'transaksis' => $transaksis,
            'totalOmzet' => $totalOmzet,
            'bulan'      => $bulan->format('Y-m'),
            'labelBulan' => $bulan->translatedFormat('F Y'),
        ]);
    }


    public function cetakBulanan(Request $request)
    {
        $request->validate([
            'bulan' => 'required|date_format:Y-m',
        ]);

        $bulan = Carbon::createFromFormat('Y-m', $request->bulan);

        $start = $bulan->copy()->startOfMonth();
        $end   = $bulan->copy()->endOfMonth();

        // 🔒 HARUS SAMA PERSIS DENGAN LAPORAN
        $transaksis = Transaksi::with(['keranjang.item.produk'])
            ->where('status', 'selesai')
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('created_at')
            ->get();

        $totalOmzet = $transaksis->sum('total_harga');

        $pdf = Pdf::loadView('pengguna.owner.Laporan_Transaksi.pdf_bulanan', [
            'transaksis' => $transaksis,
            'totalOmzet' => $totalOmzet,
            'bulan'      => $bulan->translatedFormat('F Y'),
        ]);

        return $pdf->stream(
            'laporan-transaksi-' . $bulan->format('Y-m') . '.pdf'
        );
    }



    /**
     * Laporan penjualan per menu / produk
     */
    public function laporanMenu(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date|before_or_equal:today',
            'end_date'   => 'nullable|date|before_or_equal:today|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');
        $today     = Carbon::now()->format('Y-m-d');

        $produks = Produk::with('kategori')
            ->withSum(
                [
                    'itemKeranjang as total_terjual' => function ($q) use ($startDate, $endDate) {
                        $q->join('keranjang', 'item_keranjang.keranjang_id', '=', 'keranjang.id')
                            ->join('transaksi', 'keranjang.kode_pesanan', '=', 'transaksi.kode_pesanan')
                            ->where('transaksi.status', 'selesai');

                        if ($startDate && $endDate) {
                            $q->whereBetween('transaksi.created_at', [
                                Carbon::parse($startDate)->startOfDay(),
                                Carbon::parse($endDate)->endOfDay(),
                            ]);
                        }
                    },
                ],
                'jumlah'
            )
            ->withSum(
                [
                    'itemKeranjang as total_pendapatan' => function ($q) use ($startDate, $endDate) {
                        $q->join('keranjang', 'item_keranjang.keranjang_id', '=', 'keranjang.id')
                            ->join('transaksi', 'keranjang.kode_pesanan', '=', 'transaksi.kode_pesanan')
                            ->where('transaksi.status', 'selesai');

                        if ($startDate && $endDate) {
                            $q->whereBetween('transaksi.created_at', [
                                Carbon::parse($startDate)->startOfDay(),
                                Carbon::parse($endDate)->endOfDay(),
                            ]);
                        }
                    },
                ],
                DB::raw('item_keranjang.jumlah * harga')
            )
            ->orderByDesc('total_terjual')
            ->get();


        return view(
            'pengguna.owner.Laporan_Transaksi.menu',
            compact('produks', 'startDate', 'endDate', 'today')
        );
    }

    /**
     * Laporan penjualan per kategori
     */
    public function laporanKategori(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date|before_or_equal:today',
            'end_date'   => 'nullable|date|before_or_equal:today|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');
        $today     = Carbon::now()->format('Y-m-d');

        $kategoris = Kategori::leftJoin('produk', 'produk.kategori_id', '=', 'kategori.id')
            ->leftJoin('item_keranjang', 'item_keranjang.produk_id', '=', 'produk.id')
            ->leftJoin('keranjang', 'keranjang.id', '=', 'item_keranjang.keranjang_id')
            ->leftJoin('transaksi', 'transaksi.kode_pesanan', '=', 'keranjang.kode_pesanan')
            ->where(function ($q) {
                $q->whereNull('transaksi.status')
                    ->orWhere('transaksi.status', 'selesai');
            })
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereBetween('transaksi.created_at', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay()
                ]);
            })
            ->groupBy('kategori.id', 'kategori.kategori')
            ->select(
                'kategori.id',
                'kategori.kategori',
                DB::raw('COALESCE(SUM(item_keranjang.jumlah), 0) as total_terjual'),
                DB::raw('COALESCE(SUM(item_keranjang.jumlah * produk.harga), 0) as total_pendapatan')
            )
            ->get();

        return view(
            'pengguna.owner.Laporan_Transaksi.kategori',
            compact('kategoris', 'startDate', 'endDate', 'today')
        );
    }
}
