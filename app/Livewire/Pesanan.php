<?php

namespace App\Livewire;

use App\Models\Penjual;
use App\Models\Produk;
use Livewire\Component;

class Pesanan extends Component
{
    public $penjualId;

    public function clickPenjual($penjualId)
    {
        $this->penjualId = $penjualId;
    }

    public function render()
    {
        return view('livewire.pesanan', [
            'produk' => Produk::all(),
        ]);
    }
}
