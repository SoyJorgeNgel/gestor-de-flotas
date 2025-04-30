<?php

namespace App\Livewire\Cajas;

use App\Models\Cajas\Box_type;
use Livewire\Component;

class CreateTypes extends Component
{
    public $open = false;
    public $name;

    public function render()
    {
        return view('livewire.cajas.create-types');
    }
    public function register()
{
    $validatedData = $this->validate([
        'name' => 'required|string|max:255|unique:box_types,name'
    ]);

    Box_type::create([
        'name' => $validatedData['name']
    ]);

    $this->dispatch('box_type-created');
    $typeCreated = "El tipo de caja " . $validatedData['name'] ." ha sido creado";
    $this->dispatch('alert', $typeCreated);

    $this->reset(['open', 'name']);
}

}
