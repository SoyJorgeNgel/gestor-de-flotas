<?php

namespace App\Livewire\Cajas;

use App\Models\Cajas\Box_size;
use Livewire\Component;

class CreateSizes extends Component
{
    public $open = false;
    public $size;
    public function render()
    {
        return view('livewire.cajas.create-sizes');
    }
    public function register()
    {
        $validateData = $this->validate([
            'size' => 'required|string|max:255|unique:box_sizes,name'
        ]);
        Box_size::create([
            'name' => $validateData['size']
        ]);
        $this->dispatch('box_size-created');
        $sizeCreated = "El tamaño de caja " . $validateData['size'] . " ha sido creado";
        $this->dispatch('alert', $sizeCreated);
        $this->reset(['open', 'size']);
    }
}
