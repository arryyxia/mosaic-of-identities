<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'nama',
        'penjual_id',
        'deskripsi',
        'harga',
        'pembagian',
        'pembagian_value',
        'jatah_pusdis',
        'jatah_penjual',
    ];

    public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'penjual_id');
    }
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'produk_id');
    }
    public function pesananProduk()
    {
        return $this->hasMany(PesananProduk::class, 'produk_id');
    }
}
