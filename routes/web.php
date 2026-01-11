<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DapurController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', [AuthenticatedSessionController::class, 'create'])
// ->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//pembeli
//scan untuk memesan
// Route::get('/scan/{qr_access}', [QRController::class, 'scan'])->name('scan.qr');

// pembeli masuk untuk memesan
// Halaman awal scan meja
Route::get('/pesan/{qr_access}', [OrderController::class, 'index']);

// Proses pembuatan keranjang
Route::post('/keranjang/buat', [OrderController::class, 'store'])->name('keranjang.store');

// Proses pembuatan pesanan
Route::get('/pesanan/daftar_menu', [OrderController::class, 'daftarMenu'])
    ->name('daftar_menu');

// Route untuk AJAX tambah/kurangi item
Route::post('/tambah-item', [OrderController::class, 'tambahItem'])->name('tambah-item');

// Route untuk halaman ringkasan keranjang
Route::get('/keranjang', [OrderController::class, 'lihatKeranjang'])->name('keranjang.lihat');

//untuk checkout
Route::post('/checkout', [OrderController::class, 'checkout'])
    ->name('checkout');

//untuk pesanan sukses
// Route::get('/pesanan/sukses', [OrderController::class, 'pesananSukses'])
//     ->name('pesanan_sukses');

Route::get('/pesanan/sukses/{transaksi}', [OrderController::class, 'pesananSukses'])
    ->name('pesanan_sukses');


Route::get('/qris/pay/{transaksi}', [OrderController::class, 'pay'])
    ->name('qris.pay');
Route::post('/midtrans/notification', [OrderController::class, 'handle']);

Route::get('/cek-status/{id}', function ($id) {
    $transaksi = \App\Models\Transaksi::findOrFail($id);
    return response()->json([
        'status' => $transaksi->status
    ]);
});


// Route::post('/midtrans/callback', [OrderController::class, 'callback']);





// Owner
Route::middleware(['auth', 'role:owner'])->group(function () {
    // redirect setelah login
    Route::get('/owner/dashboard', function () {
        return view('pengguna.owner.dashboard');
    });

    //kelola meja
    Route::resource('meja', MejaController::class);
    Route::get('meja/{id}/download-qr', [MejaController::class, 'downloadQr'])
        ->name('meja.download-qr');

    //kelola kategori
    Route::resource('kategori', KategoriController::class);

    //kelola menu
    Route::resource('produk', ProdukController::class);

    //kelola pengguna
    Route::resource('pengguna', PenggunaController::class);

    //kelola laporan transaksi
    Route::prefix('laporan/transaksi')->name('laporan.transaksi.')->group(function () {
        Route::get('/bulanan', [TransaksiController::class, 'laporanBulanan'])
            ->name('bulanan');

        Route::get('/bulanan/cetak', [TransaksiController::class, 'cetakBulanan'])
            ->name('bulanan.cetak');
    });

    // Route::get('/kategorilaporan', [TransaksiController::class, 'laporanKategori'])->name('kategorilaporan');
    // Route::get('/menu', [TransaksiController::class, 'laporanMenu'])->name('menu');
});

// Kasir
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir/dashboard', function () {
        return view('pengguna.kasir.dashboard');
    });

    Route::get('/pesanan', [OrderController::class, 'daftarPesananKasir'])
        ->name('kasir.pesanan');

    Route::post('/terima/{id}', [OrderController::class, 'terimaPembayaran'])
        ->name('kasir.terima');

    Route::get('/nota/{id}', [OrderController::class, 'cetakNota'])
        ->name('kasir.nota');
});

// Dapur
Route::middleware(['auth', 'role:dapur'])
    ->prefix('dapur')
    ->name('dapur.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('pengguna.dapur.dashboard');
        })->name('dashboard');

        Route::get('/pesanan', [OrderController::class, 'daftarPesananDapur'])
            ->name('pesanan');

        Route::get('/pesanan/{id}', [OrderController::class, 'detailPesananDapur'])
            ->name('detail');

        Route::post('/pesanan/{id}/selesai', [OrderController::class, 'selesaikanPesanan'])
            ->name('selesai');

        Route::get('/pesanan/data', [OrderController::class, 'pesananDapurAjax'])
            ->name('pesanan.data');

        Route::get('/stok', [DapurController::class, 'stok'])->name('stok');
        Route::post('/stok/{produk}/tambah', [DapurController::class, 'tambahStok'])->name('stok.tambah');
    });




require __DIR__ . '/auth.php';
