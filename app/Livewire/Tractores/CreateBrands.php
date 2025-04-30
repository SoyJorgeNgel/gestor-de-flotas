<?php

namespace App\Livewire\Tractores;

use App\Models\Tractores\Truck_brand;
use Livewire\Component;

class CreateBrands extends Component
{
    public $open = false;
    public $brand;

    public function render()
    {
        return view('livewire.tractores.create-brands');
    }

    public function register() {
        $validateData = $this->validate([
            'brand' => 'required|string|max:255|unique:truck_brands,name'
        ]);
        Truck_brand::create([
            'name' => $validateData['brand']
        ]);
        $brandCreate = "La marca " . $this->brand . " se ha creado";
        $this->dispatch('model-created');
        $this->dispatch('brand-created');
        $this->dispatch('alert' ,$brandCreate);

        $this->reset(['open', 'brand']);
    }
}

