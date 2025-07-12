<?php

namespace App\Livewire\Forms;

use App\Models\Penjual;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PenjualForm extends Form
{
    #[Validate('required', message: 'Nama penjual harus diisi')]
    public $nama = '';


    public function setPenjual($id)
    {
        $item = Penjual::find($id);
        $this->nama = $item->nama;
    }

    public function store($id = null)
    {
        $this->validate();

        $model = Penjual::find($id);

        if (!$id) {
            Penjual::create($this->all());
        } else {
            $model->update($this->all());
        }
    }
}
