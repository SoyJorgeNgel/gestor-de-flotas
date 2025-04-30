<?php

namespace App\Livewire;

use Livewire\Component;

class Prueba extends Component
{
    public $suma = 0;

    public function render()
    {
        return view('livewire.prueba');
    }
    public function sumar(){
        $this->suma ++ ;
    }
}
