<?php

namespace App\Livewire\Tractores;

use App\Models\Tractor;
use App\Models\Tractores\Truck_model;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateTractors extends Component
{
    public $open = false;
    public $serialNumber, $truck_model_id, $plate, $mileage ,$user_id , $models_select, $users_select;
    public function render()
    {
        return view('livewire.tractores.create-tractors');
    }
    public function mount()
    {
        $this->models_select = Truck_model::all();
        $this->users_select = User::where('role_id', 3)->get();

    }

    public function register() {
        $validateData = $this->validate([
            'serialNumber' => 'required|string|max:255',
            'truck_model_id' => 'required|integer',
            'plate' => [
                'required',
                'string',
                'max:10',
                'regex:/^(?:[a-zA-Z0-9]+-?){6,7}(?<!-)$/',
                function ($attribute, $value, $fail) {
                    $existsInBoxes = DB::table('boxes')->where('plate', $value)->exists();
                    $existsInTractors = DB::table('tractors')->where('plate', $value)->exists();
        
                    if ($existsInBoxes || $existsInTractors) {
                        $fail('La placa ya está registrada en cajas o tractores.');
                    }
                }
            ],
            'mileage' => 'required|integer',
            'user_id' => 'required|integer'
        ], [
            'serialNumber.required' => 'El número de serie es obligatorio.',
            'serialNumber.string' => 'El número de serie debe ser una cadena de texto.',
            'serialNumber.max' => 'El número de serie no debe tener más de 255 caracteres.',
            'truck_model_id.required' => 'El modelo del camión es obligatorio.',
            'truck_model_id.integer' => 'El modelo del camión debe ser un número entero.',
            'plate.required' => 'La placa es obligatoria.',
            'plate.string' => 'La placa debe ser una cadena de texto.',
            'plate.max' => 'La placa no debe tener más de 10 caracteres.',
            'plate.regex' => 'La placa no tiene un formato válido.',
            'mileage.required' => 'El kilometraje es obligatorio.',
            'mileage.integer' => 'El kilometraje debe ser un número entero.',
            'user_id.required' => 'El chofer del usuario es obligatorio.',
            'user_id.integer' => 'El chofer del usuario debe ser un número entero.',
        ]);
        
        
        Tractor::create([
            'serialNumber' => $validateData['serialNumber'],
            'truck_model_id' => $validateData['truck_model_id'],
            'plate' => $validateData['plate'],
            'mileage' => $validateData['mileage'], 
            'user_id' => $validateData['user_id']
        ]);
        $tractorCreate = "El tractor " . $this->plate . " se ha creado";
        $this->dispatch('tractor-created');
        $this->dispatch('alert' ,$tractorCreate);

        $this->reset(['serialNumber', 'truck_model_id', 'plate', 'mileage', 'user_id', 'open']);
    }

}
