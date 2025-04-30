<?php

namespace App\Livewire\Viajes;

use App\Models\Destination;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ShowDestinations extends Component
{
    use WithPagination;
    public $search, $destinationEditId, $destination, $delete_id;
    public $openEditDestination = false;
    public $neighborhoods = [];
    public $destinationEdit = [
        'institution' => '',
        'zip_code' => '',
        'state' => '',
        'locality' => '',
        'neighborhood' => '',
        'street' => '',
        'number' => ''
    ];
    #[On('box-created')]
    public function render()
    {
        // Reset pagination to 1 when the search query changes
        if ($this->search !== '' && $this->search !== old('search')) {
            $this->resetPage();
        }

        $data = Destination::where('institution', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.viajes.show-destinations', [
            'data' => $data,
            'neighborhoods' => $this->neighborhoods,
        ]);
    }
    public function fetchCopomexInfo()
    {
        $response = Http::get('https://api.copomex.com/query/info_cp/' . $this->destinationEdit['zip_code'], [
            'token' => '93120ac1-02c3-43bd-9117-60dbab79f527',
            'type' => 'simplified', 
        ]);

        if (!$response->json()['error']) {
            $copomex = $response->json()['response'];

            $this->destinationEdit['state'] = strtoupper($copomex['estado']);
            $this->destinationEdit['locality'] = strtoupper($copomex['municipio']);
            $this->neighborhoods = array_map('strtoupper', $copomex['asentamiento']);

        } else {
            // Manejar el error si la API devuelve un error
            $errorMessage = $response->json()['error_message'];
            $this->addError('zipCode', $errorMessage);
        }
    }
    public function editDestination($destinationId)
    {
        $this->destinationEditId = $destinationId;
        $this->openEditDestination = true;
        $destination = Destination::find($destinationId);
        $this->destinationEdit['institution'] = $destination->institution;
        $this->destinationEdit['zip_code'] = $destination->zip_code;
        $this->destinationEdit['state'] = $destination->state;
        $this->destinationEdit['locality'] = $destination->locality;
        $this->destinationEdit['neighborhood'] = "";
        $this->destinationEdit['street'] = $destination->street;
        $this->destinationEdit['number'] = $destination->number;
    }
    public function updateDestination()
    {
        $destination = Destination::find($this->destinationEditId);
        $destination->update(['institution' => $this->destinationEdit['institution']]);
        $destination->update(['zip_code' => $this->destinationEdit['zip_code']]);
        $destination->update(['state' => $this->destinationEdit['state']]);
        $destination->update(['locality' => $this->destinationEdit['locality']]);
        $destination->update(['neighborhood' => $this->destinationEdit['neighborhood']]);
        $destination->update(['street' => $this->destinationEdit['street']]);
        $destination->update(['number' => $this->destinationEdit['number']]);
        $destinationUpdate = "El tractor " . $this->destinationEdit['institution'] . " se ha actualizado";
        $this->dispatch('user-created');
        $this->dispatch('alert' ,$destinationUpdate);
        $this->reset(['destinationEditId', 'destinationEdit', 'openEditDestination']);
    }

    public function deleteConfirmation($id){
        $this->delete_id = $id;
        $this->dispatch('show-delete-confirmation');
    }

    #[On('deleteConfirmed')]
    public function destroy()
    {
        $destination = Destination::find($this->delete_id);
        $destination->delete();
        $destinationDelete = "El destino se ha eliminado";
        $this->dispatch('user-created');
        $this->dispatch('alert' ,$destinationDelete);
        $this->reset(['delete_id']);
    }

}
