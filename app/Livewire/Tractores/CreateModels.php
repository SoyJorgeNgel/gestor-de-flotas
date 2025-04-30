<?php

namespace App\Livewire\Tractores;

use App\Models\Tractores\Truck_brand;
use App\Models\Tractores\Truck_model;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateModels extends Component
{
    public $open = false;
    public $model, $brand, $year, $brands_select;

    public function render()
    {
        return view('livewire.tractores.create-models');
    }
    
    public function mount()
    {
        $this->brands_select = Truck_brand::all();
    }
    #[On('model-created')]
    public function resetselect()
    {
        $this->brands_select = Truck_brand::all();
    }

    public function register() {
        $validateData = $this->validate([
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'brand' => 'required|integer|max:255',
        ]);
        
        // Verificar si ya existe un registro con los mismos valores
        if (Truck_model::where('model', $validateData['model'])
            ->where('year', $validateData['year'])
            ->where('truck_brand_id', $validateData['brand'])
            ->exists()) {
            // Si existe, mostrar un mensaje de error o realizar alguna acción adecuada
            // Por ejemplo, puedes redirigir de vuelta con un mensaje de error
            $this->addError('model', 'Ya existe un registro con los mismos valores.');
            return;
        
        }
        
        Truck_model::create([
            'model' => $validateData['model'],
            'year' => $validateData['year'],
            'truck_brand_id' => $validateData['brand']
        ]);

        $modelCreate = "El modelo " . $this->model . " " .$this->year. " se ha creado";
        $this->dispatch('model-created');
        $this->dispatch('alert' ,$modelCreate);

        $this->reset(['open', 'brand', 'year', 'model']);
    }
}


