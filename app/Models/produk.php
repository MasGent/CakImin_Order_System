<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'harga',
        'deskripsi',
        'stok',
        'gambar',
        'kategori_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function itemKeranjang()
    {
        return $this->hasMany(item_keranjang::class, 'produk_id');
    }
}
