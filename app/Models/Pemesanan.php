<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// App\Models\Pemesanan
class Pemesanan extends Model
{
    protected $table = 'pemesanan';          // pakai nama tabel di migration
    protected $fillable = ['jatah_penjual', 'jatah_pusdis', 'total_harga', 'bayar', 'kembalian'];

    public function produk(): BelongsToMany
    {
        // sertakan kolom pivot 'jumlah'
        return $this->belongsToMany(Produk::class, 'pemesanan_produk')
            ->withPivot('jumlah')
            ->withTimestamps();
    }

    public function penjual()
    {
        return $this->belongsTo(Penjual::class);
    }
}
