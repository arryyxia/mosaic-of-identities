<?php

namespace App\Livewire\Forms;

use App\Models\Produk;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProdukForm extends Form
{
    #[Validate('required', message: 'Penjual harus dipilih')]
    public $penjual_id;

    #[Validate('required', message: 'Nama produk harus diisi')]
    public $nama;

    #[Validate('required', message: 'Deskripsi produk harus diisi')]
    public $deskripsi;

    #[Validate('required|numeric', message: 'Harga harus berupa angka dan minimal 1')]
    public $harga;

    #[Validate('required|in:persen,fixed', message: 'Tipe pembagian harus dipilih')]
    public $pembagian;

    #[Validate('required|numeric|min:1', message: 'Value pembagian harus angka dan minimal 1')]
    public $pembagian_value;

    public $jatah_pusdis;
    public $jatah_penjual;
    // public function setPenjual($id)
    // {
    //     $item = Penjual::find($id);
    //     $this->nama = $item->nama;
    // }


    public function setProduk($id)
    {
        $item = Produk::find($id);
        $this->penjual_id = $item->penjual_id;
        $this->nama = $item->nama;
        $this->deskripsi = $item->deskripsi;
        $this->harga = $item->harga;
        $this->pembagian = $item->pembagian;
        $this->pembagian_value = $item->pembagian_value;
        $this->jatah_pusdis = $item->jatah_pusdis;
        $this->jatah_penjual = $item->jatah_penjual;
    }

    public function save($id = null)
    {
        $this->validate();

        $model = Produk::find($id);

        if (!$id) {
            Produk::create($this->all());
        } else {
            $model->update($this->all());
        }
    }
}
