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
        'status',
    ];
    protected $casts = [
        'total_harga' => 'decimal:2',
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
