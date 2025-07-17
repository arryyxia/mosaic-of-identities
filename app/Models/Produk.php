<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /*-------------------------------------
    |  RELASI
    |------------------------------------*/

    public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'penjual_id');
    }

    /**
     * Relasi many‑to‑many ke pemesanan dengan tabel pivot
     * 'pemesanan_produk' + kolom tambahan 'jumlah'.
     */
    public function pemesanan(): BelongsToMany
    {
        return $this->belongsToMany(Pemesanan::class, 'pemesanan_produk')
            ->withPivot('jumlah')   // akses $produk->pivot->jumlah
            ->withTimestamps();
    }
}
