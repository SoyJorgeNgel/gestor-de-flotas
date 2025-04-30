<?php

namespace App\Livewire\Cajas;

use App\Models\Cajas\Box_permit;
use Livewire\Component;

class CreatePermit extends Component
{
    public $open = false;
    public $permit;
    public function render()
    {
        return view('livewire.cajas.create-permit');
    }
    public function register() {
        $validateData = $this->validate([
            'permit' => 'required|string|max:255|unique:box_permits,name'
        ]);
        Box_permit::create([
            'name' => $validateData['permit']
        ]);
        $this->dispatch('box_permit-created');
        $permitCreated = "El permiso " . $validateData['permit'] . " ha sido creado";
        $this->dispatch('alert', $permitCreated);
        $this->reset(['open', 'permit']);
    }
}
