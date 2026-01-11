<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class keranjang extends Model
{
    protected $table = 'keranjang';

    protected $fillable = [
        'kode_pesanan',
        'status',
        'meja_id',
    ];

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }

    public function item()
    {
        return $this->hasMany(item_keranjang::class, 'keranjang_id');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'kode_pesanan', 'kode_pesanan');
    }
}
