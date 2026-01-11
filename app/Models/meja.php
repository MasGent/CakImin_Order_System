<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class meja extends Model
{
    protected $table = 'meja';

    protected $fillable = [
        'nomor_meja',
        'qr_access',
        'qr_image'
    ];

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }
}
