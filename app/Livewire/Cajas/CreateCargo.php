<?php

namespace App\Livewire\Cajas;

use App\Models\Cajas\Box_cargo;
use Livewire\Component;

class CreateCargo extends Component
{
    public $open = false;
    public $cargo;
    public function render()
    {
        return view('livewire.cajas.create-cargo');
    }
    public function register() {
        $validateData = $this->validate([
            'cargo' => 'required|string|max:255|unique:box_cargos,cargo'
        ]);
        Box_cargo::create([
            'cargo' => $validateData['cargo']
        ]);
        $this->dispatch('box_cargo-created');
        $cargoCreated = "El tipo de carga " . $validateData['cargo'] . " ha sido creado";
        $this->dispatch('alert', $cargoCreated);
        $this->reset(['open', 'cargo']);
    }
}
