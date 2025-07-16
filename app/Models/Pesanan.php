<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $fillable = [
        'produk_id',
        'jumlah',
        'total_harga',
        'bayar',
        'kembalian',
    ];
    protected $casts = [
        'total_harga' => 'integer',
        'bayar' => 'integer',
        'kembalian' => 'integer',
    ];
    public function produk(): BelongsToMany
    {
        return $this->belongsToMany(Produk::class);
    }
    public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'penjual_id');
    }
}
