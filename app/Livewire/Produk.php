<?php

namespace App\Livewire;

use App\Livewire\Forms\ProdukForm;
use App\Models\Penjual;
use App\Models\Produk as ModelsProduk;
use Livewire\Component;

class Produk extends Component
{
    public ProdukForm $form;
    public $id;

    public function save()
    {
        $this->form->save($this->id);
        session()->flash('success', 'Produk berhasil ditambahkan.');
    }

    public function delete(ModelsProduk $produk)
    {
        $produk->delete();
        session()->flash('message', 'Produk telah dihapus.');
    }

    public function updated($name, $value)
    {
        if (in_array($name, [
            'form.harga',
            'form.pembagian',
            'form.pembagian_value',
        ])) {
            $this->hitungJatah();
        }
    }

    public function mount($id = null)
    {
        $this->id = $id;

        if ($id) {
            $this->form->setProduk($id);
        }
    }

    public function hitungJatah()
    {

        if (!$this->form->harga || !$this->form->pembagian || !$this->form->pembagian_value) {
            $this->form->jatah_pusdis = null;
            $this->form->jatah_penjual = null;
            return;
        }

        if ($this->form->pembagian === 'persen') {
            $jatahPusdis = ($this->form->harga * $this->form->pembagian_value) / 100;
            $jatahPenjual = $this->form->harga - $jatahPusdis;

            $this->form->jatah_pusdis = $jatahPusdis;
            $this->form->jatah_penjual = $jatahPenjual;
        } elseif ($this->form->pembagian === 'fixed') {
            $jatahPusdis = $this->form->pembagian_value;
            $jatahPenjual = $this->form->harga - $jatahPusdis;

            $this->form->jatah_pusdis = $jatahPusdis;
            $this->form->jatah_penjual = $jatahPenjual;
        } else {

        }
    }


    public function render()
    {
        return view('livewire.produk', [
            'penjual' => Penjual::all(),
            'produk' => ModelsProduk::all(),
        ]);
    }
}
