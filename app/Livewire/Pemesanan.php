<?php

namespace App\Livewire;

use App\Models\Penjual;
use App\Models\Produk;
use Livewire\Component;
use App\Livewire\Forms\PemesananForm;
use Illuminate\Support\Arr;

class Pemesanan extends Component
{
    public PemesananForm $form;
    public $produk;
    public $search = '';

    public function mount()
    {
        $this->produk = Produk::all();
    }

    /** Satu watcher cukup: selalu hitung ulang total & kembalian */
    public function updated($name, $value)
    {
        if (str_starts_with($name, 'form.')) {
            $this->hitungUlangTotal();
        }
    }

    private function hitungUlangTotal(): void
    {
        $totalHarga   = 0;
        $totalPenjual = 0;
        $totalPusdis  = 0;

        foreach ($this->produk as $p) {
            $qty = (int) ($this->form->jumlah[$p->id] ?? 0);

            $totalHarga   += $p->harga         * $qty;
            $totalPenjual += $p->jatah_penjual * $qty;
            $totalPusdis  += $p->jatah_pusdis  * $qty;
        }

        $this->form->total_harga   = $totalHarga;
        $this->form->jatah_penjual = $totalPenjual;
        $this->form->jatah_pusdis  = $totalPusdis;

        // kembalian selalu pakai total terbaru
        $bayar = (int) $this->form->bayar;
        $this->form->kembalian = max(0, $bayar - $totalHarga);
    }

    public function loadProduk()
    {
        $this->produk = Produk::when($this->search, function ($query) {
            $query->where('nama', 'like', '%' . $this->search . '%');
        })->get();
    }

    public function resetProduk()
    {
        $this->produk = Produk::all();
    }

    public function save()
    {
        // dd($this->form);
        $this->form->save();     // akan mem‑validate + simpan
        session()->flash('ok', 'Pemesanan tersimpan!');
        $this->form->reset();    // reset isian form, bukan $this->reset('form')
    }

    public function render()
    {
        return view('livewire.pemesanan', ['produk' => $this->produk]);
    }
}
