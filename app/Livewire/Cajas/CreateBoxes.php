<?php

namespace App\Livewire\Cajas;

use App\Models\Box;
use App\Models\Cajas\Box_permit;
use App\Models\Cajas\Box_size;
use App\Models\Cajas\Box_type;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateBoxes extends Component
{
    public $open = false;
    public $box_type_id, $plate, $box_size_id, $box_permit_id, $boxType_select, $boxSize_select, $boxPermit_select;
    public function render()
    {
        return view('livewire.cajas.create-boxes');
    }
    public function mount()
    {
        $this->boxType_select = Box_type::all();
        $this->boxSize_select = Box_size::all();
        $this->boxPermit_select = Box_permit::all();
    }

    public function register() {
        $validateData = $this->validate([
            'box_type_id' => 'required|integer',
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
            'box_size_id' => 'required|integer',
            'box_permit_id' => 'required|integer',
        ], [
            'box_type_id.required' => 'El tipo de caja es obligatorio.',
            'box_type_id.integer' => 'El tipo de caja debe ser un número entero.',
            'plate.required' => 'La placa es obligatoria.',
            'plate.string' => 'La placa debe ser una cadena de texto.',
            'plate.max' => 'La placa no debe tener más de 10 caracteres.',
            'plate.regex' => 'La placa no tiene un formato válido.',
            'box_size_id.required' => 'El tamaño de la caja es obligatorio.',
            'box_size_id.integer' => 'El tamaño de la caja debe ser un número entero.',
            'box_permit_id.required' => 'El permiso de la caja es obligatorio.',
            'box_permit_id.integer' => 'El permiso de la caja debe ser un número entero.',
        ]);
        
        Box::create([
            'box_type_id' => $validateData['box_type_id'],
            'box_size_id' => $validateData['box_size_id'],
            'box_permit_id' => $validateData['box_permit_id'],
            'plate' => $validateData['plate'],
        ]);
        $boxCreate = "La caja " . $this->plate . " se ha creado";
        $this->dispatch('box-created');
        $this->dispatch('alert' ,$boxCreate);

        $this->reset(['box_type_id', 'plate', 'box_size_id', 'box_permit_id', 'open']);
    }
}
