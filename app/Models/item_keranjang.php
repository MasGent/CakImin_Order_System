<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class item_keranjang extends Model
{
    protected $table = 'item_keranjang';

    protected $fillable = [
        'keranjang_id',
        'produk_id',
        'jumlah',
    ];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
