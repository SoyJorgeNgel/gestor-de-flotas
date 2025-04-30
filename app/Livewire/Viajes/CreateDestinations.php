<?php

namespace App\Livewire\Viajes;

use App\Models\Destination;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateDestinations extends Component
{
    public $open = false;
    public $neighborhoods = [];
    public $institution ,$zip_code ,$state ,$locality ,$neighborhood ,$street ,$number;
    #[On('user-created')]
    public function render()
    {
        return view('livewire.viajes.create-destinations', ['neighborhoods' => $this->neighborhoods]);
    }
    public function register() {
        $validateData = $this->validate([
            'institution' => 'required|string|max:255',
            'zip_code' => 'required|integer',
            'state' => 'string|max:255',
            'locality' => 'string|max:255',
            'neighborhood' => 'string|max:255',
            'street' => 'string|max:255|',
            'number' => 'integer'
        ]);
        Destination::create([
            'institution' => $validateData['institution'],
            'zip_code' => $validateData['zip_code'],
            'state' => $validateData['state'],
            'locality' => $validateData['locality'], 
            'neighborhood' => $validateData['neighborhood'],
            'street' => $validateData['street'], 
            'number' => $validateData['number']
        ]);
        $destinarionCreate = "El destino " . $this->institution . " se ha creado";
        $this->dispatch('user-created');
        $this->dispatch('alert' ,$destinarionCreate);

        $this->reset(['institution', 'zip_code', 'state', 'locality', 'neighborhood', 'street', 'number', 'open']);
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

