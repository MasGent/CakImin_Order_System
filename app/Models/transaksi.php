<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'nama_pemesan',
        'kode_pesanan',
        'total_harga',
        'metode_pembayaran',
        'status',
        'catatan',
        'user_id',
    ];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'kode_pesanan', 'kode_pesanan');
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function itemKeranjang()
    {
        return $this->hasMany(item_keranjang::class, 'transaksi_id');
    }
}
