<?php

namespace App\Livewire\Viajes;

use App\Models\Departure;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowDeparture extends Component
{
    use WithPagination;
    public $neighborhoods = [];
    public $search, $departureEditId, $departure, $delete_id;
    public $openEditDeparture = false;
    public $departureEdit = [
        'departure' => '',
        'zip_code' => '',
        'state' => '',
        'locality' => '',
        'neighborhood' => '',
        'street' => '',
        'number' => ''
    ];
    #[On('departure-created')]
    public function render()
    {
        if ($this->search !== '' && $this->search !== old('search')) {
            $this->resetPage();
        }

        $data = Departure::where('departure', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.viajes.show-departure', [
            'data' => $data,
            'neighborhoods' => $this->neighborhoods,
        ]);
        
    }
    public function fetchCopomexInfo()
    {
        $response = Http::get('https://api.copomex.com/query/info_cp/' . $this->departureEdit['zip_code'], [
            'token' => '93120ac1-02c3-43bd-9117-60dbab79f527',
            'type' => 'simplified', 
        ]);

        if (!$response->json()['error']) {
            $copomex = $response->json()['response'];

            $this->departureEdit['state'] = strtoupper($copomex['estado']);
            $this->departureEdit['locality'] = strtoupper($copomex['municipio']);
            $this->neighborhoods = array_map('strtoupper', $copomex['asentamiento']);
        } else {
            // Manejar el error si la API devuelve un error
            $errorMessage = $response->json()['error_message'];
            $this->addError('zipCode', $errorMessage);
        }
    }
    public function editDeparture($departureId)
    {
        $this->departureEditId = $departureId;
        $this->openEditDeparture = true;
        $departure = Departure::find($departureId);
        $this->departureEdit['departure'] = $departure->departure;
        $this->departureEdit['zip_code'] = $departure->zip_code;
        $this->departureEdit['state'] = $departure->state;
        $this->departureEdit['locality'] = $departure->locality;
        $this->departureEdit['neighborhood'] = "";
        $this->departureEdit['street'] = $departure->street;
        $this->departureEdit['number'] = $departure->number;
    }
    public function updateDeparture()
    {
        $departure = Departure::find($this->departureEditId);
        $departure->update(['departure' => $this->departureEdit['departure']]);
        $departure->update(['zip_code' => $this->departureEdit['zip_code']]);
        $departure->update(['state' => $this->departureEdit['state']]);
        $departure->update(['locality' => $this->departureEdit['locality']]);
        $departure->update(['neighborhood' => $this->departureEdit['neighborhood']]);
        $departure->update(['street' => $this->departureEdit['street']]);
        $departure->update(['number' => $this->departureEdit['number']]);
        $departureUpdate = "El tractor " . $this->departureEdit['departure'] . " se ha actualizado";
        $this->dispatch('user-created');
        $this->dispatch('alert' ,$departureUpdate);
        $this->reset(['departureEditId', 'departureEdit', 'openEditDeparture']);
    }
    public function deleteConfirmation($id){
        $this->delete_id = $id;
        $this->dispatch('show-delete-confirmation');
    }

    #[On('deleteConfirmed')]
    public function destroy()
    {
        $departure = Departure::find($this->delete_id);
        $departure->delete();
        $departureDelete = "El destino se ha eliminado";
        $this->dispatch('departure-created');
        $this->dispatch('alert' ,$departureDelete);
        $this->reset(['delete_id']);
    }
}
