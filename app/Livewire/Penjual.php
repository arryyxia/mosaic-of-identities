<?php

namespace App\Livewire;

use App\Livewire\Forms\PenjualForm;
use App\Models\Penjual as ModelsPenjual;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Penjual extends Component
{
    public PenjualForm $form;
    public $id_penjual;

    public function mount($id = null)
    {
        $this->id_penjual = $id;
        if($id) {
            $this->form->setPenjual($id);
        }
    }

    public function delete(ModelsPenjual $penjual)
    {
        $penjual->delete();
        session()->flash('message', 'Penjual telah dihapus.');
    }
    
    public function save()
    {
        $this->form->store($this->id_penjual);
        session()->flash('success', 'Penjual berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.penjual', [
            'penjual' => ModelsPenjual::all(),
        ]);
    }
}
