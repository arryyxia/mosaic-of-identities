<?php

namespace App\Livewire;

use App\Models\Penjual;
use Livewire\Component;

class Pesanan extends Component
{
    public function render()
    {
        return view('livewire.pesanan', [
            'penjual' => Penjual::all(),
        ]);
    }
}
