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

    public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'penjual_id');
    }
    public function pesanan(): BelongsToMany
    {
        return $this->belongsToMany(Pesanan::class);
    }
}   
