<?php

namespace App\Http\Controllers;

use App\Models\item_keranjang;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\meja;
use App\Models\Produk;
use App\Models\transaksi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\Writer\PdfWriter;
use Midtrans\CoreApi;
use Midtrans\Notification;



class OrderController extends Controller
{
    public function index($qr_access)
    {
        $meja = Meja::where('qr_access', $qr_access)->firstOrFail();

        return view('Pembeli.welcome_order', compact('meja'));
    }



    public function store(Request $request)
    {
        // 1. Cari meja berdasarkan ID atau QR Access yang dikirim
        $meja = \App\Models\Meja::where('id', $request->meja_id)
            ->orWhere('qr_access', $request->meja_id)
            ->first();

        // Validasi jika meja tidak ditemukan
        if (!$meja) {
            return redirect()->back()->with('error', 'Meja tidak valid atau tidak terdaftar.');
        }

        // --- LOGIKA TAMBAHAN: CEK PESANAN AKTIF ---
        // Cek apakah meja ini sudah memiliki keranjang dengan status 'pending'
        $pesananAktif = Keranjang::where('meja_id', $meja->id)
            ->where('status', 'pending')
            ->first();

        if ($pesananAktif) {
            // Jika masih ada yang pending, jangan buat baru.
            // Anda bisa mengarahkan kembali dengan pesan peringatan.
            return redirect()->back()->with('error', 'Meja ini masih memiliki pesanan yang belum diselesaikan (Pending).');
        }
        // ------------------------------------------

        // 2. Logika pembuatan kode pesanan unik
        $kodePesanan = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        // 3. Simpan ke tabel keranjang menggunakan ID meja yang VALID
        $keranjang = \App\Models\Keranjang::create([
            'kode_pesanan' => $kodePesanan,
            'status'       => 'pending', // Sesuai enum di database
            'meja_id'      => $meja->id,
        ]);

        session(['active_order_code' => $kodePesanan]);

        return redirect()->route('daftar_menu')->with('success', 'Silahkan pilih menu Anda!');
    }

    public function daftarMenu()
    {
        $produkPerKategori = Produk::with('kategori')
            ->orderBy('nama_produk')
            ->get()
            ->groupBy('kategori.kategori');

        $keranjangItems = [];
        $keranjangCount = 0;

        $kodePesanan = session('active_order_code');

        if ($kodePesanan) {
            $keranjang = Keranjang::where('kode_pesanan', $kodePesanan)->first();

            if ($keranjang) {
                $keranjangItems = item_keranjang::where('keranjang_id', $keranjang->id)
                    ->pluck('jumlah', 'produk_id')
                    ->toArray();

                $keranjangCount = array_sum($keranjangItems);
            }
        }

        return view('Pembeli.daftar_menu', compact(
            'produkPerKategori',
            'keranjangItems',
            'keranjangCount'
        ));
    }


    public function tambahItem(Request $request)
    {
        // 1. Ambil kode pesanan dari session
        $kodePesanan = session('active_order_code');

        // 2. Cari ID Keranjang
        $keranjang = Keranjang::where('kode_pesanan', $kodePesanan)->first();

        if (!$keranjang) {
            return response()->json(['message' => 'Sesi pesanan tidak ditemukan'], 404);
        }

        // 3. Update atau Buat Item Keranjang
        // Jika jumlah 0, maka hapus item. Jika > 0, update/create.
        if ($request->jumlah <= 0) {
            item_keranjang::where('keranjang_id', $keranjang->id)
                ->where('produk_id', $request->produk_id)
                ->delete();
            return response()->json(['message' => 'Item dihapus']);
        }

        $item = item_keranjang::updateOrCreate(
            [
                'keranjang_id' => $keranjang->id,
                'produk_id' => $request->produk_id,
            ],
            [
                'jumlah' => $request->jumlah
            ]
        );

        return response()->json([
            'message' => 'Berhasil memperbarui jumlah',
            'jumlah' => $item->jumlah
        ]);
    }

    public function lihatKeranjang()
    {
        $kodePesanan = session('active_order_code');

        if (!$kodePesanan) {
            return redirect()->route('daftar_menu')
                ->with('error', 'Silakan pilih menu terlebih dahulu.');
        }

        $keranjang = Keranjang::with(['item.produk'])
            ->where('kode_pesanan', $kodePesanan)
            ->first();

        if (!$keranjang || $keranjang->item->count() === 0) {
            return redirect()->route('daftar_menu')
                ->with('error', 'Keranjang Anda masih kosong.');
        }

        $totalHarga = $keranjang->item->sum(function ($item) {
            return ($item->jumlah ?? 0) * ($item->produk->harga ?? 0);
        });

        return view('Pembeli.ringkasan_keranjang', [
            'keranjang'   => $keranjang,
            'totalHarga' => $totalHarga,
        ]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'nama_pemesan'      => 'required|string|max:100',
            'metode_pembayaran' => 'required|in:cash,qris',
            'catatan'           => 'nullable|string',
        ]);

        $kodePesanan = session('active_order_code');
        if (!$kodePesanan) {
            return redirect()->route('daftar_menu')
                ->with('error', 'Kode pesanan tidak ditemukan.');
        }

        DB::beginTransaction();

        try {
            $keranjang = Keranjang::with('item.produk')
                ->where('kode_pesanan', $kodePesanan)
                ->where('status', 'pending')
                ->firstOrFail();

            $totalHarga = $keranjang->item->sum(
                fn ($item) => $item->jumlah * $item->produk->harga
            );

            if ($totalHarga <= 0) {
                return back()->with('error', 'Keranjang kosong.');
            }

            $status = $request->metode_pembayaran === 'cash'
                ? 'pending'
                : 'menunggu_pembayaran';

            $transaksi = Transaksi::create([
                'kode_pesanan'      => $kodePesanan,
                'nama_pemesan'      => $request->nama_pemesan,
                'total_harga'       => $totalHarga,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status'            => $status,
                'catatan'           => $request->catatan,
            ]);

            $keranjang->update(['status' => 'check-out']);

            DB::commit();

            if ($request->metode_pembayaran === 'qris') {
                return redirect()->route('qris.pay', $transaksi->id);
            }

            // JIKA BAYAR QRIS
            if ($request->metode_pembayaran === 'qris') {
                return redirect()->route('qris.pay', $transaksi->id);
            }

            // JIKA BAYAR CASH → LANGSUNG SELESAI
            return redirect()->route('pesanan_sukses', $transaksi->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function pay(Transaksi $transaksi)
    {
        if ($transaksi->status !== 'menunggu_pembayaran') {
            abort(403);
        }

        // ✅ JIKA QR SUDAH ADA, JANGAN BUAT LAGI
        if ($transaksi->qris_url && $transaksi->midtrans_order_id) {
            return view('Pembeli.qris', [
                'transaksi' => $transaksi,
                'qrisUrl'   => $transaksi->qris_url
            ]);
        }

        // ✅ ORDER ID HARUS UNIK
        $orderId = $transaksi->kode_pesanan . '-' . time();

        $params = [
            'payment_type' => 'qris',
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $transaksi->total_harga,
            ],
            'customer_details' => [
                'first_name' => $transaksi->nama_pemesan,
            ],
            'qris' => [
                'acquirer' => 'gopay'
            ]
        ];

        $response = CoreApi::charge($params);

        $qrisUrl = collect($response->actions)
            ->firstWhere('name', 'generate-qr-code')
            ->url;

        // 💾 SIMPAN KE DB (INI KRUSIAL)
        $transaksi->update([
            'midtrans_order_id' => $orderId,
            'qris_url' => $qrisUrl,
        ]);

        return view('Pembeli.qris', compact('transaksi', 'qrisUrl'));
    }


    public function handle(Request $request)
    {
        $notif = new \Midtrans\Notification();

        $orderId = $notif->order_id;
        $status  = $notif->transaction_status;

        $transaksi = Transaksi::where('midtrans_order_id', $orderId)->first();
        if (!$transaksi) {
            return response()->json(['message' => 'Not found']);
        }

        if ($status === 'settlement') {
            $transaksi->update(['status' => 'diproses']);
        } elseif (in_array($status, ['expire', 'cancel', 'deny'])) {
            $transaksi->update(['status' => 'gagal']);
        }

        return response()->json(['message' => 'OK']);
    }


    public function pesananSukses(Transaksi $transaksi)
    {
        if (!in_array($transaksi->status, ['diproses', 'pending'])) {
            abort(403, 'Pesanan belum selesai');
        }

        $keranjang = Keranjang::with('item.produk')
            ->where('kode_pesanan', $transaksi->kode_pesanan)
            ->firstOrFail();

        return view('Pembeli.pesanan_sukses', compact(
            'transaksi',
            'keranjang'
        ));
    }



    //kasir

    public function daftarPesananKasir()
    {
        $hariIni = Carbon::today();

        $pesanan = Transaksi::with(['keranjang.item.produk'])
            ->whereDate('created_at', $hariIni)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pengguna.Kasir.daftar_pesanan', compact('pesanan'));
    }

    public function terimaPembayaran($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status !== 'pending') {
            return back()->with('error', 'Pesanan sudah diproses.');
        }

        $transaksi->update([
            'status' => 'diproses',
            'user_id' => auth()->id(), // kasir
        ]);

        return back()->with('success', 'Pembayaran cash diterima.');
    }

    public function cetakNota($id)
    {
        $transaksi = Transaksi::with([
            'keranjang.item.produk'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('pengguna.Kasir.nota_pdf', compact('transaksi'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('nota-' . $transaksi->kode_pesanan . '.pdf');
    }



    // ==========================
    // LIST PESANAN UNTUK DAPUR
    // ==========================
    public function daftarPesananDapur()
    {
        $pesanan = Transaksi::with([
            'keranjang.item.produk'
        ])
            ->where('status', 'diproses')
            ->latest()
            ->get();

        return view('pengguna.dapur.daftar_pesanan', compact('pesanan'));
    }

    // Dapur
    // ==========================
    // DETAIL PESANAN
    // ==========================
    public function detailPesananDapur($id)
    {
        $pesanan = Transaksi::with([
            'keranjang.item.produk'
        ])
            ->findOrFail($id);

        return view('pengguna.dapur.detail_pesanan', compact('pesanan'));
    }

    // ==========================
    // SELESAIKAN PESANAN
    // ==========================
    public function selesaikanPesanan($id)
    {
        $pesanan = Transaksi::findOrFail($id);
        $pesanan->update(['status' => 'selesai']);

        return redirect()
            ->route('dapur.pesanan')
            ->with('success', 'Pesanan telah disajikan.');
    }

    public function pesananDapurAjax()
    {
        $pesanan = Transaksi::where('status', 'diproses')
            ->latest()
            ->get();

        return response()->json($pesanan);
    }
}
