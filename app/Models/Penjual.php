<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjual extends Model
{
    protected $table = 'penjual';

    protected $fillable = [
        'nama',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'penjual_id');
    }

    public function pemesanan()
    {
        return $this->hasManyThrough(Pemesanan::class, Produk::class, 'penjual_id', 'produk_id', 'id', 'id');
    }
}
