<?php

namespace App\Livewire\Viajes;

use App\Models\Departure;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateDeparture extends Component
{
    public $open = false;
    public $neighborhoods = [];
    public $departure ,$zip_code ,$state ,$locality ,$neighborhood ,$street ,$number;
    #[On('user-created')]
    public function render()
    {
        return view('livewire.viajes.create-departure', ['neighborhoods' => $this->neighborhoods]);
    }
    public function register() {
        $validateData = $this->validate([
            'departure' => 'required|string|max:255',
            'zip_code' => 'required|integer',

        ]);
        Departure::create([
            'departure' => $validateData['departure'],
            'zip_code' => $validateData['zip_code'],
            'state' => $this->state,
            'locality' => $this->locality, 
            'neighborhood' => $this->neighborhood,
            'street' => $this->street, 
            'number' => $this->number
        ]);
        $departureCreate = "La salida " . $this->departure . " se ha creado";
        $this->dispatch('departure-created');
        $this->dispatch('alert' ,$departureCreate);

        $this->reset(['departure', 'zip_code', 'state', 'locality', 'neighborhood', 'street', 'number', 'open']);
    }
    public function fetchCopomexInfo()
    {
        $response = Http::get('https://api.copomex.com/query/info_cp/' . $this->zip_code, [
            'token' => '93120ac1-02c3-43bd-9117-60dbab79f527',
            'type' => 'simplified', 
        ]);

        if (!$response->json()['error']) {
            $copomex = $response->json()['response'];

            $this->state = strtoupper($copomex['estado']);
            $this->locality = strtoupper($copomex['municipio']);
            $this->neighborhoods = array_map('strtoupper', $copomex['asentamiento']);
        } else {
            // Manejar el error si la API devuelve un error
            $errorMessage = $response->json()['error_message'];
            $this->addError('zipCode', $errorMessage);
        }
    }
}
